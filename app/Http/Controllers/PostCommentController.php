<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostComment;
use App\Models\PostCommentReply;
use App\Models\DiscriminationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;


class PostCommentController extends Controller
{
    public function index()
    {
        $post_comments = PostComment::with('discriminationType')->latest()->take(6)->get();
        $types = DiscriminationType::all(); 
        
    
        return view('blog.forum', compact('post_comments', 'types'));
    }
    
    public function allPosts(Request $request)
{
    $search = $request->get('search');
    $post_comments = PostComment::with('discriminationType', 'user') 
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('content', 'like', "%{$search}%")
                         ->orWhereHas('user', function ($q) use ($search) {
                             $q->where('name', 'like', "%{$search}%"); 
                         })
                         ->orWhereHas('discriminationType', function ($q) use ($search) {
                             $q->where('type', 'like', "%{$search}%"); 
                         });
        })
        ->latest()
        ->get();
    
    $types = DiscriminationType::all(); 
    
    return view('blog.allpost', compact('post_comments', 'types'));
}

    

    public function create()
    {
        $types = DiscriminationType::all();
        return view('post_comment.create', compact('types'));
    }

    public function store(Request $request)
{
    $request->validate([
        'type_id' => 'required|exists:discrimination_type,id',
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $post = new PostComment();
    $post->type_id = $request->type_id;
    $post->title = $request->title;
    $post->content = $request->content;
    $post->author_name = auth()->user()->name; 
    $post->user_id = auth()->id(); 

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $post->image = $imagePath;
    }

    $post->save();

    return redirect()->route('blog.forum')->with('success', 'Post created successfully!');
}

public function update(Request $request, $postId)
{
    try {

        Log::info('Editing post comment', ['post_id' => $postId, 'request_data' => $request->all()]);

        $postComment = PostComment::findOrFail($postId);

        Log::info('Post comment data before update', ['post_comment' => $postComment]);

        $postComment->title = $request->input('title');
        $postComment->content = $request->input('content');
        $postComment->type_id = $request->input('type_id');

        Log::info('Discrimination type ID being updated', ['type_id' => $postComment->type_id]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $postComment->image = $imagePath;
            Log::info('New image uploaded', ['image_path' => $imagePath]);
        }

        $postComment->save();

        Log::info('Post comment updated successfully', ['post_comment' => $postComment]);

        return redirect()->route('post-comment.index')->with('success', 'Post updated successfully');
    } catch (\Exception $e) {
      
        Log::error('Error updating post comment', ['error' => $e->getMessage()]);
        return back()->with('error', 'There was an issue updating the post');
    }
}



public function destroy($id)
{
    $post_comment = PostComment::findOrFail($id); 
    $post_comment->delete(); 

    return redirect()->back()->with('success', 'Post comment deleted successfully.');
}

}
