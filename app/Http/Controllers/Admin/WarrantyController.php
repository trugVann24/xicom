<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarrantyRequest;
use App\Models\Product;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WarrantyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warranties = Warranty::paginate(10);
        return Inertia::render('Admin/Warranty/Index', [
            'warranties' => $warranties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Warranty/Create', []);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(WarrantyRequest $request)
    {
        Warranty::create($request->only(['warranty_period', 'warranty_description']));
        return to_route('warranties.index')->with('message', 'Thêm bảo hành thành công'); //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warranty $warranty)
    {
        return Inertia::render('Admin/Category/Edit', [
            'warranty' => $warranty
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarrantyRequest $request, Warranty $warranty)
    {
        $warranty->fill($request->only(['warranty_period', 'warranty_description']));
        $warranty->update();
        return to_route('warranties.index')->with('message', 'Sửa bảo hành thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warranty $warranty)
    {
        $warranty->delete();
        return to_route('warranties.index')->with('message', 'Xoá bảo hành thành công');
    }
}
