<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','post_content','image_path','published_at','category_id'];



    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //remove the image from storage folder
    public function delete_image(){
        Storage::delete($this->image_path);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
   //one post has many tags
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
