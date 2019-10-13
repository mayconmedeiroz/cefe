<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id', 'dev_id', 'title', 'image', 'seriousness', 'content'
    ];
}
