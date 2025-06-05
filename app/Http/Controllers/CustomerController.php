<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    public function __construct(protected CustomerService $customerService) {}

    public function index()
    {
        $customers = Customer::with('sales')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::with('sales.items.product')->findOrFail($id);
        return view('customers.show', compact('customer'));
    }
}
