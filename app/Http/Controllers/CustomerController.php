<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

function CustomerCreate(Request $request){
    try {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'mobile' => 'required|string|min:10',
        ]);
        $user_id=Auth::id();
        Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'user_id' => $user_id

        ]);
        return response()->json(['status' => 'success', 'message' => 'Customer Added Successfully']);


    }catch(Exception $e){
        return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
    }

}



function CustomerList(){
    try {
        $user_id=Auth::id();
        $rows=Customer::where('user_id',$user_id)->get();
        return response()->json(['status' => 'success', 'rows' => $rows]);

    }catch(Exception $e){
        return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
    }
}

function CustomerDelete(Request $request){
    try {
        $request->validate(['id' => 'required|string|min:1']);
        $user_id=Auth::id();
        $customer_id=$request->input('id');
        Customer::where('id',$customer_id)->where('user_id',$user_id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Customer Deleted Successfully']);


    }catch(Exception $e){
        return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
    }
}

function CustomerByID(Request $request){
    try {
        $request->validate(['id' => 'required|min:1']);
        $user_id=Auth::id();
        $cutomer_id=$request->input('id');
        $rows=Customer::where('id',$cutomer_id)->where('user_id',$user_id)->first();
        return response()->json(['status' => 'success', 'rows' => $rows]);

    }catch(Exception $e){
        return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
    }
}

function CustomerUpdate(Request $request){
    try {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'mobile' => 'required|string|min:10',
            'id' => 'required|min:1'
        ]);
        $user_id=Auth::id();
        $customer_id=$request->input('id');
        Customer::where('id',$customer_id)->where('user_id',$user_id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile')
        ]);
        return response()->json(['status' => 'success', 'message' => 'Customer Updated Successfully']);

    }catch(Exception $e){
        return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
    }
}



// Last Bracked
}
