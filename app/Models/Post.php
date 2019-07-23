<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'image', 'category_id');
    protected $appends=['is_favourite'];
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }
    

    public function getIsFavouriteAttribute (){
        if(auth('api')->user()){
            $id=auth('api')->user()->id;
            $client=Client::find($id);
            $postsIds=$client->posts()->pluck('post_id')->toArray();
            if(in_array($this->id, $postsIds)){
                return $value = true;
            } else {
                return $value = false;
            }
        }
    }
}