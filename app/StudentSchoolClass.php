<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentSchoolClass extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $fillable = [
        'student_id', 'school_class_id', 'class_number', 'school_year_id',
    ];
}
