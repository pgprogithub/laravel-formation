<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title', 'excerpt', 'body', 'image_path', 'is_published', 'min_to_read'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function meta(){
        return $this->HasOne(PostMeta::class);
    }

    public function  categiries(){
        return $this->BelongsToMany(Category::class);
    }
}
