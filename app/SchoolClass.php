<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'class',
    ];

    public function school()
    {
        return $this->belongsTo('App\School');
    }
}
