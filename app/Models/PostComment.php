<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $table = 'post_comment'; 
    protected $primaryKey = 'post_id';
    public $timestamps = false; 

    protected $fillable = ['type_id', 'title', 'content', 'author_name', 'image', 'user_id',  'created_at'];

    protected $keyType = 'int';
    public $incrementing = true; 

    public function discriminationType()
    {
        return $this->belongsTo(DiscriminationType::class, 'type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('images/default.png');
    }

    public function getAuthorImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('images/prof1.jpeg');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id', 'post_id');
    }

    public function isLikedByUser()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function postComment()
    {
        return $this->belongsTo(PostComment::class, 'post_id');
    }
    
    public function replies()
{
    return $this->hasMany(PostCommentReply::class, 'post_id');
}


}
