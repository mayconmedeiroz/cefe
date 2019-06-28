<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class StudentSchoolClass extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'school_class_id', 'class_number', 'school_year',
    ];
}
