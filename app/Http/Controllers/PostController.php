<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    // use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // $this->authorize('viewAny', Post::class);
        Gate::authorize('viewAny', Post::class);

        $posts = Post::paginate();

        return view('post.index', compact('posts'))
            ->with('i', ($request->input('page', 1) - 1) * $posts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $post = new Post();

        return view('post.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        Post::create($request->validated());

        return Redirect::route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $post = Post::find($id);

        Gate::authorize('view', $post);

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $post = Post::find($id);

        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }

        $post->update($request->validated());

        return Redirect::route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }

        $post->delete();

        return Redirect::route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
