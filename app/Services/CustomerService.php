<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function getOrCreate(string $name, string $mobile): Customer
    {
        return Customer::firstOrCreate(
            ['mobile' => $mobile],
            ['name' => $name]
        );
    }

    public function all()
    {
        return Customer::orderBy('name')->get();
    }
}
