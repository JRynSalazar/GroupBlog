<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ApiComment;

class ApiCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
         return ApiComment::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

   
    public function store(Request $request)
{
    $request->validate([
        // 'post_id' => 'required|integer',
        'title' => 'required|string|max:255',
        'comment_text' => 'required|string',
        
    ]);

    $comment = new ApiComment();
    $comment->post_id = $request->post_id;
    $comment->user_id = auth()->id(); // ✅ get from token
    $comment->author_name = auth()->user()->name; // optional if you store user_name
    $comment->title = $request->title;
    $comment->content = $request->comment_text;
    $comment->save();

    return response()->json($comment, 201);
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return ApiComment::findOrFail($id);
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
   public function update(Request $request, $id)
    {
        $request->validate([
            'comment_text' => 'required|string',
        ]);

        $comment = ApiComment::findOrFail($id);

        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'You do not have permission to edit this comment.'], 403);
        }

        $comment->content = $request->comment_text;

        $comment->save();

        return response()->json($comment, 200);
    }


    public function destroy(string $id)
    {
        $comment = ApiComment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
