<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'evaluation_id', 'attendance'
    ];
}
