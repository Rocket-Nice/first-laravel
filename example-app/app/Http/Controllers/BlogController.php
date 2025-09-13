<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        try {
            $blogs = Blog::all();
            
            return response()->json([
                'status' => 'success',
                'data' => $blogs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch blogs',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $blog = Blog::find($id);
            
            if (!$blog) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Blog not found'
                ], 404);
            }
            
            return response()->json([
                'status' => 'success',
                'data' => $blog
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch blog',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}