<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
    * @property int $id
    * @property int $day_id
    * @property int $exercise_id
    * @property int $count
    * @property int $weight
    */
class Dayexercise extends Model
{
    use Notifiable;
    protected $fillable = ['day_id','exercise_id','count','weight'];
}
