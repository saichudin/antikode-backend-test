<?php

namespace App\Http\Controllers;

use App\Http\Resources\OutletResource;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlets = Outlet::all();
        $outlets->load('brand');

        return OutletResource::collection($outlets);
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
            'address' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string'
        ]);

        $picture = Storage::disk('public')->putFile('outlet/picture', $request->file('picture'), 'public');

        $outlet = Outlet::create($request->only(
            'name','brand_id','address','longitude','latitude'
            ) + [
                'picture' => $picture
            ]);
        $outlet->load('brand');

        return new OutletResource($outlet);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        $outlet->load('brand');

        return new OutletResource($outlet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        $this->validate($request, [
            'name' => 'string',
            'brand_id' => 'exists:brands,id',
            'picture' => 'image',
            'address' => 'string',
            'longitude' => 'string',
            'latitude' => 'string'
        ]);

        $outlet->update($request->only('name','brand_id','address','longitude','latitude'));

        if ($request->hasFile('picture')) {
            $oldFile = $outlet->picture;
            Storage::disk('public')->delete($oldFile); // delete old file on storage
            $picture = Storage::disk('public')->putFile('outlet/picture', $request->file('picture'), 'public');
            $outlet->update(['picture' => $picture]);
        }
        $outlet->load('brand');

        return new OutletResource($outlet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        $outlet->delete();
    }
}
