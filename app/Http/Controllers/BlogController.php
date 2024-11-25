<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Requests\CommentRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
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

        return view('blog.create', ['allCategories' => Category::all()]);
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

        $validated = $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $blog->categories()->syncWithoutDetaching($validated['categories']);

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

        return view('blog.edit', ['blog' => $blog, 'allCategories' => Category::all()]);
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
        Gate::authorize('delete', $blog);

        $blog->delete();
        return redirect()->route('blog.index')
            ->with('success', 'Blog deleted successfully.');
    }

    public function addCategories(Request $request, Blog $blog)
    {
        Gate::authorize('update', $blog);

        $validated = $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $blog->categories()->syncWithoutDetaching($validated['categories']);

        return redirect()->route('blog.edit', ['blog' => $blog])
            ->with('success', 'Categories added successfully.');
    }

    public function removeCategories(Request $request, Blog $blog)
    {
        Gate::authorize('update', $blog);

        $validated = $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $blog->categories()->detach($validated['categories']);

        return redirect()->route('blog.edit', ['blog' => $blog])
            ->with('success', 'Categories removed successfully.');
    }

    public function addComment(Request $request, Blog $blog)
    {
        $request->validate([
            'comment' => 'required|max:500',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'blog_id' => $blog->id,
            'content' => $request->comment,
        ]);

        return redirect()->route('blog.show', ['blog' => $blog])
            ->with('success', 'Comment added successfully.');
    }

    public function removeComment(Blog $blog, Comment $comment)
    {
        $comment->delete();

        return redirect()->route('blog.show', ['blog' => $blog])
            ->with('success', 'Comment successfully deleted.');
    }
}
