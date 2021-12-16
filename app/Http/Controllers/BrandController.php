<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();

        return BrandResource::collection($brands);
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
            'logo' => 'required|image',
            'banner' => 'required|image',
        ]);

        $logo = Storage::disk('public')->putFile('brand/logo', $request->file('logo'), 'public');
        $banner = Storage::disk('public')->putFile('brand/banner', $request->file('banner'), 'public');

        $brand = Brand::create($request->only('name') + [
            'logo' => $logo,
            'banner' => $banner,
        ]);

        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $brand->load('outlets','products');

        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'name' => 'string',
            'logo' => 'image',
            'banner' => 'image',
        ]);

        $brand->update($request->only('name'));

        if ($request->hasFile('logo')) {
            $oldFile = $brand->logo;
            Storage::disk('public')->delete($oldFile); // delete old file on storage
            $logo = Storage::disk('public')->putFile('brand/logo', $request->file('logo'), 'public');
            $brand->update(['logo' => $logo]);
        }

        if ($request->hasFile('banner')) {
            $oldFile = $brand->banner;
            Storage::disk('public')->delete($oldFile); // delete old file on storage
            $banner = Storage::disk('public')->putFile('brand/banner', $request->file('banner'), 'public');
            $brand->update(['banner' => $banner]);
        }

        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if ($brand->has('outlets') || $brand->has('products')) {
            throw ValidationException::withMessages(['message' => 'tidak bisa hapus brand yang sudah punya outlet atau product']);
        }

        $brand->delete();
    }
}
