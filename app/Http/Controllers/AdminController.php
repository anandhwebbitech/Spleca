<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;

class AdminController extends Controller
{
    //
     public function Dashboard()
    {
        $data = [
        'categoryCount'     => Category::count(),
        'subcategoryCount'  => SubCategory::count(),
        'productCount'      => Product::count(),
        'orderCount'        => Order::count(),
        'enquiryCount'      => Enquiry::count(),
    ];
        return view('admin.pages.dashboard',$data);
    }
    public function AdminLoginPage(){
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $user = Auth::user();

            // ADMIN
            if ($user->role == 1) {
                return response()->json([
                    'status'   => true,
                    'redirect' => route('admin.dashboard')
                ]);
            }

            // NOT ADMIN → LOGOUT & REDIRECT TO HOME
            Auth::logout();

            return response()->json([
                'status'   => false,
                'redirect' => route('homepage'),
                'message'  => 'You are not authorized to access admin panel'
            ], 403);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Invalid email or password'
        ], 401);
    }

    public function CategoryPage()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.pages.category', compact('categories'));
    }
    public function MainCategoryPage()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.pages.categorymain', compact('categories'));
    }
}
