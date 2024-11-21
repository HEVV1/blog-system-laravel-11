<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Gate;

class BlogController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::query();

        $blogs->when(request('search'), fn($q) => $q->where('title', 'like', '%' . request('search') . '%'))
            ->orWhere('body', 'like', '%' . request('search') . '%');

        return view('blog.index', ['blogs' => $blogs->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            Gate::authorize('create', Blog::class);
        } catch (AuthorizationException $e) {
            return redirect()->route('login');
        }

        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
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
