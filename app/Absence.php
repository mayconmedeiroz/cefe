<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_grade_id', 'absences'
    ];

    public function studentGrade()
    {
        return $this->belongsTo('App\StudentGrade');
    }
}
