<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

   protected $fillable = [
       'body',
       'postId',
       'user_id', // Add user_id to the fillable property
       'username'
   ];

   public function post()
   {
       return $this->belongsTo(Post::class);
   }

   public function user()
   {
       return $this->belongsTo(User::class);
   }
} 