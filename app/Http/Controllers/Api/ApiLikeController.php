<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;

class ApiLikeController extends Controller
{
    public function toggleLike(Request $request)
{
    try {
        $request->validate([
            'post_id' => 'required|exists:post_comment,post_id',
        ]);

        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $postId = $request->post_id;

        $existingLike = Like::where('post_id', $postId)
                            ->where('user_id', $userId)
                            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['message' => 'Post unliked successfully.'], 200);
        } else {
            Like::create([
                'post_id' => $postId,
                'user_id' => $userId,
            ]);
            return response()->json(['message' => 'Post liked successfully.'], 201);
        }

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'error' => 'Validation failed',
            'details' => $e->errors()
        ], 422);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while toggling like',
            'details' => $e->getMessage()
        ], 500);
    }
}



    
    public function getLikes($postId)
{
    try {
        if (empty($postId)) {
            return response()->json(['error' => 'Post ID is required'], 400);
        }

        if (!\App\Models\PostComment::find($postId)) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $likeCount = Like::where('post_id', $postId)->count();

        return response()->json([
            'post_id' => $postId,
            'like_count' => $likeCount
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while retrieving likes',
            'details' => $e->getMessage()
        ], 500);
    }
}


}
