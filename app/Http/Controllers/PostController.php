<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return Inertia::render('Admin/Posts/Index', [
            'posts' => PostResource::collection($posts)
        ]);
    }

    public function create()
    {
        // $this->authorize('create', Post::class);
        return Inertia::render('Admin/Posts/Create');
    }

    public function store(PostRequest $request)
    {
        // $this->authorize('create', Post::class);
        Post::create($request->validated());

        return to_route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        // $this->authorize('update', $post);
        return Inertia::render('Admin/Posts/Edit', [
            'post' => new PostResource($post)
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->validated());

        return to_route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        // $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}