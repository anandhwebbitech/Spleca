<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    //
    public function OrderFetch()
    {
        $orders = OrderItem::with([
            'order.user',
            'product'
        ])
            ->whereHas('order', function ($q) {
                $q->where('status', 2);
            });
        return DataTables()->of($orders)
            ->addIndexColumn()

            ->addColumn('order_id', function ($row) {
                return $row->order
                    ? 'ORD-' . $row->id
                    : '-';
            })

            ->addColumn('customer_name', function ($row) {
                return $row->order->user->name ?? '-';
            })

            ->addColumn('product_name', function ($row) {
                return $row->product->name ?? '-';
            })

            ->addColumn('discount', function ($row) {
                return number_format($row->discount ?? 0, 2);
            })

            ->addColumn('total_amount', function ($row) {
                return number_format($row->original_price ?? 0, 2);
            })

            ->addColumn('order_date', function ($row) {
                return optional($row->order->created_at)->format('d-m-Y');
            })

            ->addColumn('delivery_date', function ($row) {
                if (!empty($row->order->delivery_date)) {
                    return \Carbon\Carbon::parse($row->order->delivery_date)->format('d-m-Y');
                }
                return '-';
            })

            ->addColumn('status', function ($row) {
                switch ($row->order->order_status) {
                    case Order::DELIVERED:
                        return '<span class="badge bg-success">Delivered</span>';
                    case Order::CONFIRM:
                        return '<span class="badge bg-info">Confirm</span>';
                    case Order::CANCEL:
                        return '<span class="badge bg-danger">Cancelled</span>';
                    case Order::RETURN:
                        return '<span class="badge bg-danger">Returned</span>';
                    default:
                        return '<span class="badge bg-warning">Pending</span>';
                }
            })

            ->addColumn('action', function ($row) {
                return '<a class="btn btn-sm btn-primary viewOrderBtn" data-id="'.$row->order->id.'" title="View">
                            <i class="fas fa-eye"></i>
                        </a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    public function PaymentFetch()
    {
        $orders = Payment::with([
            'order',
        ]);
        return DataTables()->of($orders)
            ->addIndexColumn()
            ->addColumn('customer_name', function ($row) {
                return $row->order->user->name ?? '-';
            })

            ->addColumn('product_name', function ($row) {
                return $row->order->product->name ?? '-';
            })

            ->addColumn('total_amount', function ($row) {
                return number_format($row->amount ?? 0, 2);
            })
            ->rawColumns(['customer_name', 'product_name','total_amount'])
            ->make(true);
    }

    public function show(Request $request)
    {
        $order = Order::with(['user', 'address'])->findOrFail($request->id);

        return response()->json($order);
    }

    public function updateStatus(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->order_status = $request->order_status;
        $order->save();

        return response()->json([
            'message' => 'Order status updated successfully'
        ]);
    }
    public function EnquiryStore(Request $request)
    {
        $request->validate([
            // 'product_id' => 'required|exists:products,id',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:20',
            'message'    => 'required|string',
        ]);
        $product = Product::where('id',$request->product_id)->first();
        // dd($request->subject);
        $enquirySave = Enquiry::create([
            'product_id' => $request->product_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'message'    => $request->message,
            'subject'    => $request->filled('subject') ? $request->subject : null,
        ]);
        $enquiry = [
            'product_id' => $product ? $product->name : null,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'message'    => $request->message,
            'subject'    => $request->filled('subject') ? $request->subject : null,
            ];
            if($enquirySave)
            {
                Mail::send('pages.enquiryemail', ['enquiry' => $enquiry], function ($message) use ($enquiry) {

                    $message->from('spleca@gmail.com', 'SPLECA')
                            ->to('anandhwebbitech@gmail.com')
                            ->subject('New Enquiry submitted');
                });
            }


        return back()->with('success', 'Enquiry submitted successfully!');
    }



    // ENQUERY

    public function EnquiryFetch()
    {
        $enquiry = Enquiry::with([
            'product'
        ]);
        // dd($enquiry->get());
        return DataTables()->of($enquiry)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name ?? '-';
            })

            ->addColumn('product_name', function ($row) {
                return $row->product->name ?? '-';
            })

            ->addColumn('enquiry_date', function ($row) {
                if (!empty($row->created_at)) {
                    return \Carbon\Carbon::parse($row->created_at)->format('d-m-Y');
                }
                return '-';
            })
            ->addColumn('status', function ($row) {
                switch ($row->status) {
                    case Enquiry::PROCESS:
                        return '<span class="badge bg-primary">Process</span>';
                    case Enquiry::CONFIRM:
                        return '<span class="badge bg-warning">Confirm</span>';
                    case Enquiry::CANCEL:
                        return '<span class="badge bg-danger">Cancelled</span>';
                    case Enquiry::COMPLETE:
                        return '<span class="badge bg-success">Complete</span>';
                    default:
                        return '<span class="badge bg-info">Pending</span>';
                }
            })

            ->addColumn('action', function ($row) {
                return '<a class="btn btn-sm btn-primary viewOrderBtn" data-id="'.$row->id.'" title="View">
                            <i class="fas fa-eye"></i>
                        </a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    public function EnquiryShow(Request $request)
    {
        $enquiry = Enquiry::with(['product'])->findOrFail($request->id);

        return response()->json($enquiry);
    }
     public function enquiryStatus(Request $request)
    {
        $order = Enquiry::findOrFail($request->order_id);
        $order->status = $request->order_status;
        $order->save();

        return response()->json([
            'message' => 'Enquiry status updated successfully'
        ]);
    }
}
