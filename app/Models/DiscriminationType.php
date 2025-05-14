<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscriminationType extends Model
{
    use HasFactory;

    protected $table = 'discrimination_type';

    protected $fillable = ['type'];

    public function postComments()
    {
        return $this->hasMany(PostComment::class, 'type_id');
    }
}
