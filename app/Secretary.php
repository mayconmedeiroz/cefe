<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'secretary_id', 'school_id'
    ];
}
