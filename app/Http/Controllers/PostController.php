<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use App\Queries\PostQuery;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;

class PostController extends Controller
{

    public function index()
    {
        $posts = (new PostQuery)->paginate((int) request()->query('perPage', 10));

        return new PostResourceCollection($posts);
    }

    public function store(User $user, PostRequest $request)
    {
        $data = $request->validated();

        $post = Post::create($data);

        return response()->json(new PostResource($post), 201);
    }

    public function show(Post $post)
    {
        return new PostResource($post->load(['user']));
    }

    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();
        
        $post->update($data);

        return response()->json($post, 204);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204);
    }
}
