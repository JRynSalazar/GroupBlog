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
    try {
        // Check if the ID is missing or empty
        if (empty($id)) {
            return response()->json(['error' => 'Comment ID is required'], 400);
        }

        // Validate request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'comment_text' => 'required|string',
        ]);

        // Attempt to find the comment
        $comment = ApiComment::findOrFail($id);

        // Check if the authenticated user is authorized to update the comment
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'You do not have permission to edit this comment.'], 403);
        }

        // Update comment fields
        $comment->title = $validatedData['title'];
        $comment->content = $validatedData['comment_text'];
        $comment->save();

        return response()->json($comment, 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Comment not found'], 404);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while updating the comment',
            'details' => $e->getMessage()
        ], 500);
    }
}



    public function destroy(?string $id)
{
    try {
       
        if (empty($id)) {
            return response()->json(['error' => 'Comment ID is required'], 400);
        }

        $comment = ApiComment::findOrFail($id);

   
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Comment not found'], 404);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while deleting the comment'], 500);
    }
}

}
