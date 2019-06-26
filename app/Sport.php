<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'acronym',
    ];
}
