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

    public function scopeSport()
    {
        return $this->belongsTo('App\Sport');
    }

    public function scopeSportToEnroll($query, $sport)
    {
        return $query->join('sports', function($join) use($sport){
            $join->on('sports.id', '=', 'sport_classes.sport_id')
                ->when($sport, function ($query) use($sport) {
                    return $query->where('sports.id', $sport);
                })
                ->whereNull('sports.deleted_at');
            });
    }

    public function scopeTeacher($query, $teacher)
    {
        return $query->join('class_teachers', function($join) use($teacher){
            $join->on('class_teachers.class_id', '=', 'sport_classes.id')
                ->when($teacher, function ($query) use($teacher) {
                    return $query->where('class_teachers.teacher_id', $teacher);
                })
                ->whereNull('class_teachers.deleted_at');
            })
            ->join('users', 'users.id', '=', 'class_teachers.teacher_id');
    }

    public function scopeWeekday($query, $weekday)
    {
        if (isset($weekday)) {
            return $query->where('sport_classes.weekday', $weekday);
        }
        return $query;
    }


    public function scopeStartTime($query, $startTime)
    {
        if (isset($startTime)) {
            return $query->where('sport_classes.start_time', '>=', $startTime);
        }
        return $query;
    }


    public function scopeEndTime($query, $endTime)
    {
        if (isset($endTime)) {
            return $query->where('sport_classes.end_time', '<=', $endTime);
        }
        return $query;
    }

}
