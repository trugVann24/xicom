<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return Inertia::render('Admin/Brand/Index', [
            'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Brand/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image/brands'), $imageName);
        }
        Brand::create([
            'name' => $request->input('name'),
            'image' => $imageName,
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status'),
        ]);

        return to_route('brands.index')->with('message', 'Thêm thương hiệu thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brands)
    {
        // try {
        //     $imagePath = public_path('image/brands/') . $brands->image;
        //     if (File::exists($imagePath)) {
        //         File::delete($imagePath);
        //     }
            $brands->products()->delete();
            $brands->delete();
        // } catch (\Exception $e) {
        //     Log::error('Error deleting brand: ' . $e->getMessage());
        //     return redirect()->route('brands.index')->withErrors('Lỗi xảy ra khi xoá thương hiệu.');
        // }
        return to_route('brands.index')->with('message', 'Xoá thương hiệu thành công');
    }
}
