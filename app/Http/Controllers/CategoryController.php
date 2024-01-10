<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{



    function CategoryList(Request $request){

        try{
            $user_id=Auth::id();
            $rows=Category::where('user_id',$user_id)->get();
            return response()->json(['status' => 'success', 'rows' => $rows]);

        }catch(Exception $e){
            return $e;
        }
    }




    function CategoryCreate(Request $request){
        try{
       $request->validate(['name'=>'required|string|min:2']);
       $user_id=Auth::id();
       Category::create(['name'=>$request->name,'user_id'=>$user_id]);
       return response()->json(['status' => 'success', 'message' => 'Category Created Successfully']);
        }catch(Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

}



