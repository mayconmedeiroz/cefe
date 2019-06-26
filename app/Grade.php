<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'grade_1', 'attendance_1', 'grade_2', 'attendance_2', 'grade_3', 'attendance_3', 'school_year'
    ];
}
