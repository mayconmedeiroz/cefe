<?php

namespace CEFE;

use Illuminate\Database\Eloquent\Model;

class SportClassLesson extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sport_class_id', 'evaluation_id', 'planned_classes', 'classes_held'
    ];
}
