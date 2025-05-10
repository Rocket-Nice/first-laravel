<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(1);
        return view('posts.index', ['posts' => $posts]);
        // dd($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
        // Вариант вручную добавлять данные
        // $postsArr = [
        //     [
        //         'title' => 'New title name',
        //         'content' => 'govno content',
        //         'image' => 'image.jpg',
        //         'likes' => 20,
        //         'is_published' => 1
        //     ],
        //     [
        //         'title' => 'Другие данные',
        //         'content' => 'Другие данные',
        //         'image' => 'image2.jpg',
        //         'likes' => 21,
        //         'is_published' => 2
        //     ]
        // ];

        // foreach ($postsArr as $key) {
        //     Post::create($key);
        // }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required',
            // 'email' => 'required|email|unique:users',
        ]);

        // Затягивает целиком данные формы
        // Post::create($request->all());

        // Только валидированные
        Post::create($validated);
        return redirect()->route('posts.index');
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
