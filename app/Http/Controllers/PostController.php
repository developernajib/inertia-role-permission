<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Initialize the PermissionController with middleware that sets the authenticated user.
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function index()
    {
        Gate::authorize('view', $this->user);
        $posts = PostResource::collection(Post::paginate(10));
        return Inertia::render('Admin/Posts/Index', [
            'posts' => Inertia::defer(fn() => $posts->collection->toArray())->merge(),
            'currentPage' => $posts->resource->currentPage(),
        ]);
    }

    public function create()
    {
        Gate::authorize('create', $this->user);
        return Inertia::render('Admin/Posts/Create');
    }

    public function store(PostRequest $request)
    {
        Gate::authorize('create', $this->user);
        Post::create($request->validated());

        return to_route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $this->user);
        return Inertia::render('Admin/Posts/Edit', [
            'post' => new PostResource($post)
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        Gate::authorize('update', $this->user);
        $post->update($request->validated());

        return to_route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $this->user);
        $post->delete();
        return back();
    }
}
