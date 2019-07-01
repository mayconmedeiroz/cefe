<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id', 'evaluation_id', 'attendance'
    ];
}
