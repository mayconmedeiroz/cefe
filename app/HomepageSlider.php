<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class HomepageSlider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image'
    ];
}
