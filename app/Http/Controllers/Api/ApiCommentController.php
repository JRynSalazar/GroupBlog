<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ApiComment;

class ApiCommentController extends Controller
{
   
    public function index()
    {
        
         return ApiComment::all();
    }

    
    public function create()
    {
     
    }

   
    public function store(Request $request)
{
    $request->validate([
       
        'title' => 'required|string|max:255',
        'comment_text' => 'required|string',
        
    ]);

    $comment = new ApiComment();
    $comment->post_id = $request->post_id;
    $comment->user_id = auth()->id(); // 
    $comment->author_name = auth()->user()->name;
    $comment->title = $request->title;
    $comment->content = $request->comment_text;
    $comment->save();

    return response()->json($comment, 201);
}



    public function show(string $id)
    {
         return ApiComment::findOrFail($id);
    }

    
    public function edit(string $id)
    {
        //
    }

   
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
