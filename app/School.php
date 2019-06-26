<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name', 'acronym'
    ];
}
