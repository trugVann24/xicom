<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])->paginate(5);
        return Inertia::render('Admin/Product/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });
        $warranties = Warranty::all()->map(function ($warranty) {
            return [
                'id' => $warranty->id,
                'warranty_period' => $warranty->warranty_period,
            ];
        });
        $brands = Brand::all()->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
            ];
        });
        return Inertia::render('Admin/Product/Create', [
            'categories' => $categories,
            'brands' => $brands,
            'warranties' => $warranties,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('image/products'), $imageName);
        }
        Product::create([
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'warranty_id' => $request->input('warranty_id'),
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'image' => $imageName,
            'price' => $request->input('price'),
            'import_price' => $request->input('import_price'),
            'sold_quantity' => $request->input('sold_quantity'),
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

        return to_route('products.index');
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
    public function destroy(string $id)
    {
        //
    }
}
