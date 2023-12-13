<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return Inertia::render('Admin/Supplier/Index', [
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Supplier/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        Supplier::create($request->only(['name', 'email', 'phone', 'address']));
        return to_route('suppliers.index')->with('message', 'Thêm nhà cung cấp thành công');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return Inertia::render('Admin/Supplier/Edit', [
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->fill($request->only(['name', 'email', 'phone', 'address']));
        $supplier->update();
        return to_route('suppliers.index')->with('message', 'Sửa nhà cung cấp thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return to_route('suppliers.index')->with('message', 'Xoá nhà cung cấp thành công');
    }
}
