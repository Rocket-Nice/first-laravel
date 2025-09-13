<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $posts = Post::all();
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
        // dd($posts); // Убрал dd для нормальной работы
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required',
            'image' => 'nullable|string',
            'likes' => 'nullable|integer',
            'is_published' => 'nullable|boolean'
        ]);

        Post::create($validated);
        
        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required',
            'image' => 'nullable|string',
            'likes' => 'nullable|integer',
            'is_published' => 'nullable|boolean'
        ]);

        $post->update($validated);
        
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    // Вспомогательные методы для тестирования

    public function createSecond(): string
    {
        $postsArr = [
            [
                'title' => 'New title name',
                'content' => 'Sample content',
                'image' => 'image.jpg',
                'likes' => 20,
                'is_published' => 1
            ],
            [
                'title' => 'Другие данные',
                'content' => 'Другие данные',
                'image' => 'image2.jpg',
                'likes' => 21,
                'is_published' => 1
            ]
        ];

        foreach ($postsArr as $postData) {
            Post::create($postData);
        }

        return "Test posts created successfully!";
    }

    public function updateSecond(): string
    {
        $post = Post::find(6);
        
        if ($post) {
            $post->update([
                'title' => 'Updated title name ' . now(),
                'content' => 'Updated content ' . now(),
                'image' => 'updated_image.jpg',
                'likes' => rand(50, 200),
                'is_published' => 1
            ]);
            
            return "Post #6 updated successfully!";
        }
        
        return "Post #6 not found! Create it first.";
    }

    public function deleteSecond(): string
    {
        // $post = Post::find(6);
        
        // if ($post) {
        //     $post->delete();
        //     return "Post #6 deleted successfully!";
        // }
        
        // return "Post #6 not found! Create it first.";

        $post = Post::withTrashed()->find(1);
        $post->restore();
        return "Post #6 restored successfully!";
    }
}