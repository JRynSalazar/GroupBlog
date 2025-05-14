<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike($postId)
    {
        $postComment = PostComment::findOrFail($postId);

        $user = Auth::user();
        $like = $postComment->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
        
            $postComment->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }
        return response()->json([
            'likes_count' => $postComment->likes->count(),
            'liked' => $liked
        ]);
    }
}
