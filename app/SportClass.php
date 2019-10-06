<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportClass extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sport_id', 'name', 'weekday','start_time', 'end_time', 'vacancies'
    ];

    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }
}
