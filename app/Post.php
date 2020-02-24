<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'content', 'image', 'published_at', 'category_id',
    ];

    /**
     * delete post image from storage
     * @return void
     */
    public function deleteImage()
    {
        Storage::delete($this -> image);
        // used in postscontroller
    }

    //def relationship
    public function category()
    {
        return $this -> belongsTo(Category::class);
    }
}
