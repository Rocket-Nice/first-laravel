<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $customers = Customer::all();
            
            return response()->json([
                'status' => 'success',
                'data' => $customers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch customers',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $customer = Customer::find($id);
            
            if (!$customer) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Customer not found'
                ], 404);
            }
            
            return response()->json([
                'status' => 'success',
                'data' => $customer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}