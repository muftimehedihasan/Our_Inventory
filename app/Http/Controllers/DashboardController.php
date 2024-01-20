<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function Summary(Request $request){

    try {

        $user_id=Auth::id();

        $product= Product::where('user_id',$user_id)->count();
        $Category= Category::where('user_id',$user_id)->count();
        $Customer=Customer::where('user_id',$user_id)->count();
        $Invoice= Invoice::where('user_id',$user_id)->count();
        $total=  Invoice::where('user_id',$user_id)->sum('total');
        $vat= Invoice::where('user_id',$user_id)->sum('vat');
        $payable =Invoice::where('user_id',$user_id)->sum('payable');

        return response()->json(['status' => 'success', 'product' => $product,'category' => $Category,'customer' => $Customer,'invoice' => $Invoice,'total' => $total,'vat' => $vat,'payable' => $payable]);

    }catch (Exception $e){
        return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
    }
    }


}
