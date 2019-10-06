<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recuperation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_grade_id', 'grade'
    ];
}
