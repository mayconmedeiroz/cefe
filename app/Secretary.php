<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'secretary_id', 'school_id'
    ];

    public function user()
    {
        return $this->belongsTo('CEFE\User', 'secretary_id');
    }

    public function school()
    {
        return $this->belongsTo('CEFE\School');
    }
}
