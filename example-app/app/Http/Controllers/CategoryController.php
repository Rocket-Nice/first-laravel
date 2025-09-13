<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    public function show($id)
    {
        $category = Category::find($id);
        
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }
}