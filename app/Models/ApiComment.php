<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiComment extends Model
{
    protected $table = 'post_comment';
    protected $primaryKey = 'post_id';
    protected $autoIncrement = true;

    protected $fillable = [
        'post_id',
        'user_name',
        'title',
        'comment_text',
        'comment_date'
    ];

    public $timestamps = false;
}
