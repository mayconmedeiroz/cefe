<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'enrollment', 'name', 'email', 'password', 'avatar', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function classTeachers()
    {
        return $this->belongsToMany('App\SportClass', 'class_teachers', 'teacher_id', 'class_id');
    }

    public function secretary()
    {
        return $this->hasMany('App\Secretary', 'secretary_id');
    }

    public function studentSchoolClass()
    {
        return $this->belongsToMany('App\SchoolClass', 'student_school_classes', 'student_id')->withPivot(['class_number', 'school_year_id'])->whereNull('student_school_classes.deleted_at');
    }

    public function studentClass()
    {
        return $this->belongsToMany('App\SportClass', 'student_classes', 'student_id')->withPivot('school_year_id')->whereNull('student_classes.deleted_at');
    }

    public function studentSchool()
    {
        return $this->hasManyThrough('App\School', 'App\StudentClass');
    }

}
