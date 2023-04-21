<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Products::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productName = $request->input('name');
        $productPrice = $request->input('price');
        $productDescription = $request->input('description');

        $product = Products::create([
            'name' => $productName,
            'price' => $productPrice,
            'description' => $productDescription,
        ]);

        return response()->json([
            'data' => new ProductResource($product)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $productName = $request->input('name');
        $productPrice = $request->input('price');
        $productDescription = $request->input('description');

        $product->update([
            'name' => $productName,
            'price' => $productPrice,
            'description' =>$productDescription
        ]);

        return response()->json([
            'data' => new ProductResource($product)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return response()->json([null, 204]);
    }
}
