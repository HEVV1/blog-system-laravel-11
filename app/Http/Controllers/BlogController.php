<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\User;
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
            ->orWhere('body', 'like', '%' . request('search') . '%')->latest();

        return view('blog.index', ['blogs' => $blogs->paginate(10)]);
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
    public function store(BlogRequest $request)
    {
        Gate::authorize('create', Blog::class);

        $blog = Blog::create([
            ...$request->validated(),
            'user_id' => $request->user()->id
        ]);

        return redirect()->route('blog.show', ['blog' => $blog])
            ->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blog.show', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        Gate::authorize('update', $blog);
        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        Gate::authorize('update', $blog);
        $blog->update($request->validated());

        return redirect()->route('blog.show', ['blog' => $blog])
            ->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
//        try {
            Gate::authorize('delete', $blog);
//        } catch (AuthorizationException $e) {
//            return redirect()->route('login');
//        }

        $blog->delete();
        return redirect()->route('blog.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
