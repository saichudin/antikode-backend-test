<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $products->load('brand');

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'picture' => 'required|image',
            'price' => 'required|numeric|min:0',
        ]);

        $picture = Storage::disk('public')->putFile('product/picture', $request->file('picture'), 'public');

        $product = Product::create($request->only(
            'name','brand_id','price'
            ) + [
                'picture' => $picture
            ]);
        $product->load('brand');

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('brand');

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'string',
            'brand_id' => 'exists:brands,id',
            'picture' => 'image',
            'price' => 'numeric|min:0',
        ]);

        $product->update($request->only('name','brand_id','price'));
        if ($request->hasFile('picture')) {
            $oldFile = $product->picture;
            Storage::disk('public')->delete($oldFile); // delete old file on storage
            $picture = Storage::disk('public')->putFile('product/picture', $request->file('picture'), 'public');
            $product->update(['picture' => $picture]);
        }
        $product->load('brand');

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
