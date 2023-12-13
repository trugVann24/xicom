<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::paginate(10);
        return Inertia::render('Admin/Customer/Index', [
            'customers'=>$customers
        ]);
    }
}
