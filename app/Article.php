<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
		'title', 'user_id', 'content', 'image', 'status', 'category_id', 'featured', 'date'
	];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
