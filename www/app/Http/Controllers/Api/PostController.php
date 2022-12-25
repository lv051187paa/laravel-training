<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = Post::with(['comments'])->get();

        return response()->json([
            'status' => true,
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest  $request
     * @return JsonResponse
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        if ($request->validated()) {
            $post = Post::create($request->all());

            return response()->json([
                'status' => true,
                'message' => "Post Created Successfully",
                'post' => $post
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Error",
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StorePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return JsonResponse
     */
    public function update(StorePostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Post Updated Successfully",
            "post" => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([
            'status' => true,
            'message' => "Post Deleted Successfully"
        ]);
    }
}
