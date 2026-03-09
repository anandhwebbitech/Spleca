<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductResource;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;



class ProductController extends Controller
{
    //
    public function ProductPage()
    {
        $categories = Category::where('status', 1)->get();
        $subcategories = SubCategory::where('categories',4 )->where('status',1)->get();
        return view('admin.pages.product', compact('categories','subcategories'));
    }
    public function fetch()
    {
        $product = Product::with('category')->latest()->get();
        // dd($product);
        return Product::with('category')->latest()->get();
    }
    /* =========================
        STORE / UPDATE
    ========================== */
    public function store(Request $request)
    {
        /* ================= VALIDATION ================= */

        $rules = [
            'category_id'  => 'required|integer',
            'name'         => 'required|string|max:255',
            'quantity'     => 'required|integer',
            'stock_status' => 'required',
            'images.*'     => 'image|mimes:jpg,jpeg,png,webp|max:5120' // 5MB
        ];

        if ($request->has('variants') && count($request->variants) > 0) {
            $rules['variants'] = 'required|array';
            $rules['variant_prices'] = 'required|array';
            $rules['variants.*'] = 'required|string';
            $rules['variant_prices.*'] = 'required|numeric';
        } else {
            $rules['price'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => implode('<br>', $validator->errors()->all())
            ]);
        }

        DB::beginTransaction();

        try {
            $PRICE_MULTIPLIER = 90.91;

            /* ================= UPLOAD IMAGES ONLY ONCE ================= */

            $uploadedImages = $this->uploadProductImages($request);

            /* ================= WITH VARIANTS ================= */

            if ($request->has('variants') && count($request->variants) > 0) {

                foreach ($request->variants as $key => $variantName) {

                    // Safe price handling
                    $variantPrice = isset($request->variant_prices[$key])
                        ? (float) $request->variant_prices[$key]
                        : 0;

                    $finalVariants = [];
                    foreach ($request->variants as $i => $name) {
                        $basePrice = isset($request->variant_prices[$i])
                            ? (float) $request->variant_prices[$i]
                            : 0;

                        $finalVariants[] = [
                            'name'  => $name,
                            'price' => $basePrice
                        ];
                    }

                    $currentItem = $finalVariants[$key];
                    unset($finalVariants[$key]);

                    $finalVariants = array_merge(
                        [$currentItem],
                        array_values($finalVariants)
                    );

                    $product = Product::create([
                        'category_id'      => $request->category_id,
                        'sub_category_id'  => $request->sub_category_id,
                        'name'             => $request->name . ' - ' . $variantName,
                        'sub'              => $request->type,
                        // 'price'            => round($variantPrice * $PRICE_MULTIPLIER, 2),
                        'price'            =>$variantPrice,
                        'quantity'         => $request->quantity,
                        'stock_status'     => $request->stock_status,
                        'short_description' => $request->short_description,
                        'description'      => $request->description,
                        'status'           => 1,
                        'is_feature'       => $request->has('is_featured') ? 1 : 0,
                        'is_best_seller'   => $request->has('is_best_seller') ? 1 : 0,
                        'variant_name'     => $variantName,
                        'variants'         => json_encode($finalVariants),
                        // 👇 ADD THIS
                        'additional_sub_category' => 
                            $request->has('add_sub_category_id') 
                                ? json_encode($request->add_sub_category_id) 
                                : null,
                    ]);

                    $product->sku = str_pad($product->id, 8, '0', STR_PAD_LEFT);
                    $product->product_number = str_pad($product->id, 7, '0', STR_PAD_LEFT);
                    $product->save();

                    // Attach images
                    foreach ($uploadedImages as $imageName) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image'      => $imageName
                        ]);
                    }
                }
            }
            /* ================= WITHOUT VARIANTS ================= */ else {
                $basePrice = (float) $request->price;
                $product = Product::create([
                    'category_id'      => $request->category_id,
                    'sub_category_id'  => $request->sub_category_id,
                    'name'             => $request->name,
                    'sub'              => $request->type,
                    'price'            =>$basePrice ,
                    'quantity'         => $request->quantity,
                    'stock_status'     => $request->stock_status,
                    'short_description' => $request->short_description,
                    'description'      => $request->description,
                    'status'           => 1,
                    'is_feature'       => $request->has('is_featured') ? 1 : 0,
                    'is_best_seller'   => $request->has('is_best_seller') ? 1 : 0,
                    // 👇 ADD THIS
                        'additional_sub_category' => 
                            $request->has('add_sub_category_id') 
                                ? json_encode($request->add_sub_category_id) 
                                : null,
                ]);

                $product->sku = str_pad($product->id, 8, '0', STR_PAD_LEFT);
                $product->product_number = str_pad($product->id, 7, '0', STR_PAD_LEFT);
                $product->save();

                foreach ($uploadedImages as $imageName) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $imageName
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Product saved successfully'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    private function uploadProductImages1($request)
    {
        $uploadedImages = [];

        if ($request->hasFile('images')) {

            $uploadPath = public_path('uploads/products');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            foreach ($request->file('images') as $image) {

                if (!$image->isValid()) {
                    continue;
                }

                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);

                $imageName = time() . '_' . uniqid() . '_' . $cleanName . '.' . $image->getClientOriginalExtension();

                $image->move($uploadPath, $imageName);

                $uploadedImages[] = $imageName;
            }
        }

        return $uploadedImages;
    }
    private function uploadProductImages($request)
    {
        $uploadedImages = [];

        if ($request->hasFile('images')) {

            $uploadPath = public_path('uploads/products');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            foreach ($request->file('images') as $image) {

                if (!$image->isValid()) {
                    continue;
                }

                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $cleanName = preg_replace('/[^A-Za-z0-9\-]/', '_', $originalName);

                // Force WebP extension
                $imageName = time() . '_' . uniqid() . '_' . $cleanName . '.webp';
                $destination = $uploadPath . '/' . $imageName;

                // Get original size & type
                list($width, $height, $type) = getimagesize($image->getPathname());

                // Create source image
                switch ($type) {
                    case IMAGETYPE_JPEG:
                        $src = imagecreatefromjpeg($image->getPathname());
                        break;
                    case IMAGETYPE_PNG:
                        $src = imagecreatefrompng($image->getPathname());
                        break;
                    case IMAGETYPE_WEBP:
                        $src = imagecreatefromwebp($image->getPathname());
                        break;
                    default:
                        continue 2; // Skip unsupported types
                }

                $newWidth = 600;
                $newHeight = 600;

                // Create blank 600x600 canvas
                $dst = imagecreatetruecolor($newWidth, $newHeight);

                // White background (important for PNG transparency)
                $white = imagecolorallocate($dst, 255, 255, 255);
                imagefill($dst, 0, 0, $white);

                // Maintain ratio
                $ratio = min($newWidth / $width, $newHeight / $height);
                $resizeWidth = intval($width * $ratio);
                $resizeHeight = intval($height * $ratio);

                $x = intval(($newWidth - $resizeWidth) / 2);
                $y = intval(($newHeight - $resizeHeight) / 2);

                // Resize image
                imagecopyresampled(
                    $dst,
                    $src,
                    $x,
                    $y,
                    0,
                    0,
                    $resizeWidth,
                    $resizeHeight,
                    $width,
                    $height
                );

                // Save as WebP (quality 80)
                imagewebp($dst, $destination, 80);

                imagedestroy($src);
                imagedestroy($dst);

                $uploadedImages[] = $imageName;
            }
        }

        return $uploadedImages;
    }
    /* =========================
        EDIT
    ========================== */
   public function edit($id)
    {
        // $product = Product::with('images')->findOrFail($id);
        // return response()->json($product);
        $product = Product::with('images')->findOrFail($id);

        // Decode variants JSON safely
        $variants = [];

        if (!empty($product->variants)) {
            $decoded = json_decode($product->variants, true);

            if (is_array($decoded)) {
                $variants = $decoded;
            }
        }   
        return response()->json([
            'id'                => $product->id,
            'name'              => $product->name,
            'sub'               => $product->sub,
            'price'             => $product->price,
            'quantity'          => $product->quantity,
            'category_id'       => $product->category_id,
            'sub_category_id'   => $product->sub_category_id,
            'brand_id'          => $product->brand_id,
            'short_description' => $product->short_description,
            'description'       => $product->description,
            'meta_title'        => $product->meta_title,
            'meta_description'  => $product->meta_description,
            'status'            => $product->status,
            'is_feature'        => $product->is_feature,
            'is_best_seller'    => $product->is_best_seller,
            'variant_name'      => $product->variant_name,
            'tags'              => $product->tags,
            'images'            => $product->images,
            'variants'          => $variants, // JSON decoded variants
        ]);
    }

    /* =========================
        DELETE
    ========================== */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
    
        // Decode image JSON
        $images = json_decode($product->image, true);
    
        if (!empty($images)) {
            foreach ($images as $img) {
    
                $path = public_path('uploads/products/' . $img);
    
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        }
    
        $product->delete();
    
        return response()->json([
            'status' => true,
            'message' => 'Product deleted'
        ]);
    }
    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        $path = public_path('uploads/products/' . $image->image);
        if (file_exists($path)) {
            unlink($path);
        }

        $image->delete();

        return response()->json(['status' => true]);
    }

    public function show($id)
    {
        $product = Product::with([
            'resources'
        ])->findOrFail($id);
        $wishlist = session()->get('wishlist', []);
        $wishlistIds = array_keys($wishlist);
        $inWishlist = in_array($product->id, $wishlistIds);
        return view('pages.product-details', compact('product', 'inWishlist'));
    }
    // 
    public function ProductResourceStore(Request $request)
    {
        DB::beginTransaction();

        try {

            $productId = $request->product_id;

            /* ================= VALIDATION ================= */
            $request->validate([
                'datasheet_title.*' => 'nullable|string|max:255',
                'datasheet_file.*'  => 'nullable|mimes:pdf|max:51200',
                'brochure_file.*'   => 'nullable|mimes:pdf|max:102400',
                'video_url.*'       => 'nullable|url',
                'status'            => 'required'
            ]);

            if ($request->hasFile('datasheet_file')) {

                foreach ($request->file('datasheet_file') as $index => $file) {
            
                    if (!$file) continue;
            
                    if (!$file->isValid()) continue;
            
                    // Get original file name without extension
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            
                    // Clean file name (remove special characters)
                    $cleanTitle = preg_replace('/[^A-Za-z0-9\-]/', ' ', $originalName);
            
                    // Create unique file name for storage
                    $fileName = time() . '_' . $index . '_datasheet.' . $file->getClientOriginalExtension();
            
                    $file->move(public_path('uploads/resources'), $fileName);
            
                    ProductResource::create([
                        'product_id' => $productId,
                        'type'       => 'datasheet',
                        'title'      => $cleanTitle, // ✅ original file name used as title
                        'file'       => $fileName,
                        'status'     => $request->status
                    ]);
                }
            }

            /* ================= BROCHURE ================= */
            if ($request->hasFile('brochure_file')) {
                foreach ($request->brochure_file as $index => $file) {
                    if (!$file) continue;
                    // Get original name
                    $originalName = $file->getClientOriginalName();
                    $title = pathinfo($originalName, PATHINFO_FILENAME);

                    $fileName = time() . '_' . $index . '_brochure.' . $file->extension();
                    $file->move(public_path('uploads/resources'), $fileName);

                    ProductResource::create([
                        'product_id' => $productId,
                        'type'       => 'brochure',
                        'title'      => $title,
                        'file'       => $fileName,
                        'status'     => $request->status
                    ]);
                }
            }

            /* ================= VIDEO ================= */
            if ($request->filled('video_url')) {
                foreach ($request->video_url as $url) {

                    if (!$url) continue;

                    ProductResource::create([
                        'product_id' => $productId,
                        'type'       => 'video',
                        'video_url'  => $url,
                        'status'     => $request->status
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Product resources added successfully'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    /* ================= EDIT ================= */
    public function ProductResourceEdit($id)
    {
        return ProductResource::findOrFail($id);
    }

    /* ================= UPDATE ================= */
    public function ProductResourceUpdate(Request $request, $id)
    {
        $resource = ProductResource::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($resource->file && File::exists(public_path('uploads/resources/' . $resource->file))) {
                File::delete(public_path('uploads/resources/' . $resource->file));
            }

            $file = time() . '.pdf';
            $request->file->move(public_path('uploads/resources'), $file);
            $resource->file = $file;
        }

        $resource->title = $request->title;
        $resource->video_url = $request->video_url;
        $resource->status = $request->status;
        $resource->save();

        return response()->json([
            'status' => true,
            'message' => 'Resource updated'
        ]);
    }

    /* ================= DELETE ================= */
    public function ProductResourceDestroy($id)
    {
        $resource = ProductResource::findOrFail($id);

        if ($resource->file && File::exists(public_path('uploads/resources/' . $resource->file))) {
            File::delete(public_path('uploads/resources/' . $resource->file));
        }

        $resource->delete();

        return response()->json([
            'status' => true,
            'message' => 'Resource deleted'
        ]);
    }
    public function index($productId)
    {
        $resources = ProductResource::where('product_id', $productId)->get();

        return response()->json($resources);
    }
    public function wishlistToggle($id)
    {
        $wishlist = session()->get('wishlist', []);

        if (in_array($id, $wishlist)) {
            // REMOVE
            $wishlist = array_diff($wishlist, [$id]);
            session()->put('wishlist', $wishlist);

            return response()->json([
                'status' => 'removed',
                'count'  => count($wishlist)
            ]);
        } else {
            // ADD
            $wishlist[] = $id;
            session()->put('wishlist', $wishlist);

            return response()->json([
                'status' => 'added',
                'count'  => count($wishlist)
            ]);
        }
    }

    public function wishlistCount()
    {
        return response()->json([
            'count' => count(session()->get('wishlist', []))
        ]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = Cart::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'product_id'  => $product->id,
                'quantity'    => 1,
                'offer_price' => $product->original_price ?? $product->price,
                'original_price' => $product->price,
                'discount'    => $product->discount_percent ?? 0,
                'user_id'     => Auth::id(),
                'status'      => 1
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Added to cart'
        ]);
    }

    public function cartPanel()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        $total = 0;

        foreach ($carts as $cart) {
            $price = $cart->offer_price ?? $cart->product->price;
            $total += $price * $cart->quantity;
        }

        return view('partials.cart-panel', compact('carts', 'total'));
    }

    public function toggleStatus(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }

        $product->status = $product->status == 1 ? 0 : 1;
        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'Status updated successfully'
        ]);
    }
    // cart
    public function getCart()
    {
        $cartItems = Cart::with(['product.images'])->where('user_id', auth()->id())->where('status', 1)->get();
        return response()->json(['status' => 'success', 'cartItems' => $cartItems]);
    }
    public function RemoveCart(Request $request)
    {
        $cart = Cart::where('id', $request->cart_id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found'
            ]);
        }

        $cart->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Item removed from cart'
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $cart = Cart::with('product')
            ->where('id', $request->cart_id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found'
            ]);
        }

        $newQty = $cart->quantity + (int)$request->change;

        if ($newQty < 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Quantity cannot be less than 1'
            ]);
        }

        // âœ… Product selling price
        $productPrice = $cart->product->original_price;

        // âœ… Update cart
        $cart->quantity = $newQty;
        $cart->offer_price = $productPrice * $newQty; // ðŸ”¥ IMPORTANT
        $cart->save();

        return response()->json([
            'status' => 'success',
            'quantity' => $newQty,
            'offer_price' => $cart->offer_price
        ]);
    }
    public function placeOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:customer_addresses,id'
        ]);

        $userId = Auth::id();

        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your cart is empty'
            ]);
        }

        DB::beginTransaction();

        try {
            $subtotal = 0;
            $discount = 0;

            foreach ($cartItems as $item) {
                $subtotal += $item->product->price * $item->quantity;
                $cartdiscount = $item->discount ?? 0;
                // $discountAmount = ($item->price * $cartdiscount) / 100;
                $discountAmount = ($item->product->price * $item->product->discount_percent) / 100;
                $discountTotal = $discountAmount * $item->quantity;
                $discount += $discountTotal;
            }

            $tax = $subtotal * 0.18;
            $total = $subtotal - $discount + $tax;
            // dd($total,$discount);
            // Create Order
            $order = Order::create([
                'user_id'       => $userId,
                'address_id'    => $request->address_id,
                'price'         => $subtotal,
                'discount'      => $discount,
                'tax'           => $tax,
                'original_price'   => $total,
                'order_date'    => now(),
                'delivery_date' => now()->addDays(7),
                'status'        => 1, // Pending
                'quantity'      => $item->quantity,

            ]);

            // Create Order Items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id'    => $item->product_id,
                    'quantity'      => $item->quantity,
                    'price'         => $item->product->price,
                    'original_price'   => $item->product->original_price * $item->quantity,
                    'discount'      => $item->discount
                ]);
            }

            // Clear Cart
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function userOrders()
    {
        $orders = OrderItem::with(['order', 'product.images'])
            ->whereHas('order', function ($q) {
                $q->where('user_id', auth()->id());
            })->where('status', 2)
            ->latest()
            ->get()
            ->map(function ($item) {
                $status = $item->order_status;
                return [
                    'id'           => $item->order->id,
                    'order_item_id' => $item->id,
                    'product_name' => $item->product->name,
                    'product_id'    => $item->product->id,
                    'quantity'     => $item->quantity,
                    'price'        => $item->original_price,
                    'status' =>
                    // $status == Order::CONFIRM ? 'CONFIRM' : ($status == Order::CANCEL   ? 'CANCELLED' : ($status == Order::RETURN   ? 'RETURNED'  : 'PENDING')),
                    $status = match ($status) {
                        Order::CONFIRM => 'CONFIRM',
                        Order::CANCEL  => 'CANCELLED',
                        Order::RETURN  => 'RETURNED',
                        default        => 'PENDING',
                    },
                    'order_date'   => $item->order->created_at->format('D M d Y'),
                    // 'image'        => asset('public/uploads/products/' . $item->product->images[0]->image)
                    'image'        => asset('public/uploads/products/' .
                        optional($item->product->images->first())->image)
                ];
            });
        return response()->json([
            'orders' => $orders
        ]);
    }
    public function ShowPay($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('pages.select-payment', compact('order'));
    }
    public function cashOnDelivery($order_id)
    {
        $order = Order::findOrFail($order_id);
        OrderItem::where('order_id', $order_id)
            ->update([
                'status' => 2   // processing/placed
            ]);
        $order->update([
            'payment_type' => 'cod',
            'payment_status' => '1',
            'status' => '2'
        ]);

        // return redirect("/order-success/".$order_id);
        return redirect()->route('profilepage');
    }
    public function razorpayPayment($order_id)
    {
        $order = Order::findOrFail($order_id);

        // Validate that the order total is greater than 0
        if ($order->original_price <= 0) {
            return redirect()->back()->with('error', 'Order total must be greater than 0');
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Create Razorpay order
        $razorOrder = $api->order->create([
            'receipt' => 'ORDER_' . $order->id, // convert to string with prefix
            'amount' => $order->original_price * 100,  // amount in paise
            'currency' => 'INR'
        ]);
        OrderItem::where('order_id', $order_id)
            ->update([
                'status' => 2   // processing/placed
            ]);
        $order->update([
            'payment_type' => 'Online',
            'payment_status' => '1',
            'status' => '2'
        ]);
        return view('pages.razorpay_payment', [
            'order' => $order,
            'rOrder' => $razorOrder
        ]);
    }
    public function savePayment(Request $request)
    {
        try {
            $request->validate([
                'order_id' => 'required|exists:orders,id',
                'razorpay_payment_id' => 'required',
                'razorpay_order_id' => 'required',
                'razorpay_signature' => 'required',
                'amount' => 'required|numeric'
            ]);

            $payment = Payment::create([
                'order_id' => $request->order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
                'amount' => $request->amount,
                'status' => 'completed'
            ]);

            return response()->json(['status' => 'success', 'payment_id' => $payment->id]);
        } catch (\Exception $e) {
            // Return JSON with error message
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
     public function update(Request $request, $id)
    {
        $rules = [
            'category_id'  => 'required|integer',
            'name'         => 'required|string|max:255',
            'quantity'     => 'required|integer',
            'images.*'     => 'image|mimes:jpg,jpeg,png,webp|max:5120'
        ];

        if ($request->has('variants') && count($request->variants) > 0) {
            $rules['variants'] = 'required|array';
            $rules['variant_prices'] = 'required|array';
            $rules['variants.*'] = 'required|string';
            $rules['variant_prices.*'] = 'required|numeric';
        } else {
            $rules['price'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => implode('<br>', $validator->errors()->all())
            ]);
        }

        DB::beginTransaction();

        try {

            $PRICE_MULTIPLIER = 90.91;

            $product = Product::findOrFail($id);

            /* ================= UPDATE BASIC DATA ================= */

            $product->category_id      = $request->category_id;
            $product->sub_category_id  = $request->sub_category_id;
            $product->name             = $request->name;
            $product->sub              = $request->type;
            $product->quantity         = $request->quantity;
            $product->stock_status     = $request->stock_status;
            $product->short_description = $request->short_description;
            $product->description      = $request->description;
            $product->is_feature       = $request->has('is_featured') ? 1 : 0;
            $product->is_best_seller   = $request->has('is_best_seller') ? 1 : 0;
            $product->additional_sub_category = 
            $request->filled('add_sub_category_id')
                ? json_encode($request->add_sub_category_id)
                : null;

            // /* ================= VARIANTS UPDATE ================= */

            if ($request->has('variants') && count($request->variants) > 0) {

                $finalVariants = [];

                foreach ($request->variants as $i => $name) {

                    $basePrice = isset($request->variant_prices[$i])
                        ? (float) $request->variant_prices[$i]
                        : 0;

                    $finalVariants[] = [
                        'name'  => $name,
                        'price' => $basePrice
                    ];
                }

                // Update base price as first variant
                $product->price = $finalVariants[0]['price'];
                $product->variant_name = $finalVariants[0]['name'];
                $product->variants = json_encode($finalVariants);
            } 
            else {

                $basePrice = (float) $request->price;
                $product->price = $basePrice;
                $product->variants = null;
                $product->variant_name = null;
            }

            $product->save();

            /* ================= ADD NEW IMAGES ================= */

            $uploadedImages = $this->uploadProductImages($request);

            foreach ($uploadedImages as $imageName) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $imageName
                ]);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Product updated successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
