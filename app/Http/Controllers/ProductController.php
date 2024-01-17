<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
function CreateProduct(Request $request){

    try {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'quantity' => 'required|string|min:1',
            'img_url' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id', // Assuming a 'categories' table
]);

$product = Product::create([
    'user_id' => auth()->id(), // Assuming Sanctum authentication
    'category_id' => $validatedData['category_id'],
    'name' => $validatedData['name'],
    'price' => $validatedData['price'],
    'quantity' => $validatedData['quantity'],
    'img_url' => $validatedData['img_url'],
]);



return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);


//_____________________________________________________________________________________________________________
} catch (Exception $e) {
    return response()->json(['message' => $e->getMessage()], 400);
}
}


function DeleteProduct(Request $request){
    try{
     $user_id=Auth::id();
     $request->validate([
        "id"=>'required|string',
     ]);

    Product::where('id',$request->input('id'))->where('user_id',$user_id)->delete();
    return response()->json(['message' => 'Product deleted successfully'], 204);
    }catch(Exception $e){
        return response()->json(['message' => $e->getMessage()], 400);
    }
}


function UpdateProduct(Request $request){
    try {
        $user_id=Auth::id();
        $request->validate([
            "id"=>'required|string',
            "name"=>'required|string|max:100',
            "price"=>'required|numeric',
            "quantity"=>'required|string|min:1',
            "img_url"=>'nullable|string|max:1000',
            "category_id"=>'required|exists:categories,id', // Assuming a 'categories' table
        ]);
        Product::where('id',$request->input('id'))->where('user_id',$user_id)->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'img_url' => $request->input('img_url'),
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json(['message' => 'Product updated successfully'], 200);

    }catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()], 400);
    }
}

function ProductList(Request $request){
    try{
       $user_id=Auth::id();
       $rows= Product::where('user_id',$user_id)->get();
       return response()->json(['status' => 'success', 'message' => 'Product List', 'data' => $rows], 200);

}catch (Exception $e){
    return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
}

}


function ProductByID(Request $request){
    try {
        $user_id=Auth::id();
        $request->validate(["id"=>'required|string']);
        $rows= Product::where('id',$request->input('id'))->where('user_id',$user_id)->first();
        return response()->json(['status' => 'success', 'message' => 'Product List', 'data' => $rows], 200);
    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()], 400);
    }
}


/// last braket
}
