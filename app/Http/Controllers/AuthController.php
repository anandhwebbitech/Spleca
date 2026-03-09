<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;




class AuthController extends Controller
{
    //
    public function Register(Request $request)
    {
        try {

            // VALIDATION
            $validator = Validator::make($request->all(), [
                'first_name'   => 'required|string|max:100',
                'last_name'    => 'required|string|max:100',
                'email'        => 'required|email|unique:users,email',
                'password'     => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // STORE USER
            User::create([
                'name'         => $request->first_name . ' ' . $request->last_name,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
                'role'         => 2,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Registration completed successfully'
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ]);
        }
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json([
                'status' => true,
                'redirect' => url('/home')
            ]);
        }
        return response()->json([
            'status' => false,
            'errors' => ['Invalid email or password']
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status'   => true,
            'redirect' => route('homepage')
        ]);
    }

    //Address
  public function AddressSave(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'       => 'required|string|max:100',
        'phone'      => 'required|string|max:15',
        'country'    => 'required',
        'state'      => 'required',
        'city'       => 'required',
        'address'    => 'required',
        'postalcode' => 'required|digits:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors'  => $validator->errors()
        ], 422);
    }

    CustomerAddress::updateOrCreate(
        [
            'id' => $request->address_id
        ],
        [
            'user_id'    => Auth::id(),
            'name'       => $request->name,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'country'    => $request->country,
            'state'      => $request->state,
            'city'       => $request->city,
            'postal_code' => $request->postalcode,
        ]
    );

    return response()->json([
        'success' => true,
        'message' => $request->address_id
            ? 'Address updated successfully'
            : 'Address added successfully'
    ]);
}
public function AddressEdit($id)
{
    $address = CustomerAddress::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return response()->json($address);
}

public function setDefault(Request $request)
{
    $userId = auth()->id();

    // Set all addresses to non-default
    CustomerAddress::where('user_id', $userId)
        ->update(['is_default' => 0]);

    // Set selected address as default
    CustomerAddress::where('id', $request->address_id)
        ->where('user_id', $userId)
        ->update(['is_default' => 1]);

    return response()->json([
        'status' => true,
        'message' => 'Default address updated'
    ]);
}
public function updatePassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:8|confirmed',
    ]);

    auth()->user()->update([
        'password' => Hash::make($request->password)
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Your password has been updated successfully.'
    ]);
    
}
}
