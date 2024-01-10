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
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
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



    function CategoryUpdate(Request $request){
        try{
        $request->validate(['name'=>'required|string|min:2','name'=>'required|string|min:2']);
        $category_id=$request->input('id');
        $user_id=Auth::id();
        Category::where('id',$category_id)->where('user_id', $user_id)->update(['name'=>$request->input('name')]);
        return response()->json(['status' => 'success', 'message' => 'Category Updated Successfully']);


        }catch(Exception $e){
        return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }



    function CategoryDelete(Request $request){
      try{
      $request->validate(['id'=>'required']);
      $user_id=Auth::id();
      $category_id=$request->input('id');
      Category::where('id',$category_id)->where('user_id', $user_id)->delete();
      return response()->json(['status' => 'success', 'message' => 'Category Deleted Successfully']);

      }catch(Exception $e){
      return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
      }

    }



    function CategoryByID(Request $request){
    try{
        $request->validate(['id'=>'required']);
        $category_id=$request->input('id');
        $user_id=Auth::id();
        $rows=Category::where('id',$category_id)->where('user_id', $user_id)->first();
        return response()->json(['status' => 'success', 'rows' => $rows]);

    }catch(Exception $e){
    return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);

    }

    }






// Last brake point
}



