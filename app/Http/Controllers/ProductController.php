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

/// last braket
}
