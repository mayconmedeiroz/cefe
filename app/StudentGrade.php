<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'evaluation_id', 'grade', 'school_year'
    ];
}
