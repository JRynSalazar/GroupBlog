<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCommentReply extends Model
{
    use HasFactory;
     protected $table = 'post_comment_replies';
     
    protected $fillable = ['post_id', 'user_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function postComment()
    {
        return $this->belongsTo(PostComment::class, 'post_id', 'post_id');
    }
}
