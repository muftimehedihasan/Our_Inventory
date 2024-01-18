<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    function CreateInvoice(Request $request){
        DB::beginTransaction();
        try{

            $request->validate([
                'customer_id' => 'required|string|max:50',
                'total' => 'required|string|max:50',
                'discount' => 'required|string|max:50',
                'vat' => 'required|string|max:50',
                'payable' => 'required|string|max:50',

            ]);
            $user_id=Auth::id();
            $total=$request->input('total');
            $discount=$request->input('discount');
            $vat=$request->input('vat');
            $payable=$request->input('payable');
            $customer_id=$request->input('customer_id');

            $invoice= Invoice::create([
                'user_id' => $user_id,
                'customer_id' => $customer_id,
                'total' => $total,
                'discount' => $discount,
                'vat' => $vat,
                'payable' => $payable,

            ]);

            $invoiceID=$invoice->id;

            $products=$request->input('products');
            foreach($products as $Eachproduct){
                InvoiceProduct::create([
                    'invoice_id' => $invoiceID,
                    'user_id' => $user_id,
                    'product_id' => $Eachproduct['product_id'],
                    'quantity' => $Eachproduct['quantity'],
                    'price' => $Eachproduct['price'],
                ]);

            }

            DB::commit();
            return response()->json(['message'=>'Invoice Created Successfully']);

        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['message'=>$e->getMessage()]);
        }
    }


function SelectInvoice(Request $request){
    try{
        $user_id=Auth::id();
        $rows= Invoice::where('user_id',$user_id)->with('customer')->get();
        return response()->json(['status'=>'success','rows'=>$rows]);
    }catch(Exception $e){
        return response()->json(['message'=>$e->getMessage()]);
    }
}




// Last Braked
}
