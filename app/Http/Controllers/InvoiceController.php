<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function InvoiceCreate(Request $request){
        try{
            

        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()]);
        }
    }




// Last Braked
}
