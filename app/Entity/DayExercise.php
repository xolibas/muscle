<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
    * @property int $id
    * @property int $day_id
    * @property int @exercise_id
    */
class DayExercise extends Model
{
    use Notifiable;
}
