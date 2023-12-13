<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function renderHome()
    {
        $product_latest = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where(DB::raw('LOWER(categories.name)'), strtolower('Hikivision'))
            ->select('products.*')
            ->orderBy('products.id', 'desc')
            ->get();

        return Inertia::render('Home', [
            'product_lastest' => $product_latest
        ]);
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        return Inertia::render('Client/DetailProducts', [
            'product' => $product,
        ]);
    }
    public function productAll()
    {
        $products = Product::paginate(6);
        return Inertia::render('Client/AllProductItem', [
            'products' => $products,
        ]);
    }

    public function showProductCategory(Request $request)
    {
        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category_id', $request->query('category'));
        }
        $products = $query->paginate(10);
        return Inertia::render('Client/AllProductv2', [
            'products' => $products
        ]);
    }

    public function showProductBrand(Request $request)
    {
        $query = Product::query();

        if ($request->has('brand')) {
            $query->where('brand_id', $request->query('brand'));
        }
        $products = $query->paginate(10);
        return Inertia::render('Client/AllProductv2', [
            'products' => $products
        ]);
    }

    public function showProductsByCategory($categoryId)
    {
        $category = Category::with('products')->find($categoryId);
        $products = $category->products()->paginate(10);
        if (!$category) {
            abort(404);
        }
        return Inertia::render('Client/AllProductItem', [
            'products' => $products
        ]);
    }
    public function showProductsByBrand($brandId)
    {
        $brand = Brand::with('products')->find($brandId);
        $products = $brand->products()->paginate(10);
        if (!$brand) {
            abort(404);
        }
        return Inertia::render('Client/AllProductItem', [
            'products' => $products
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->get();
        return Inertia::render('Client/Search', [
            'products' => $products,
        ]);
    }

    public function cart(){
        return Inertia::render('Client/Cart');
    }
}
