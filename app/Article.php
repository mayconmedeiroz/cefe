<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $fillable = [
		'title', 'user_id', 'content', 'image', 'status', 'category_id', 'featured', 'date'
	];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
