<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
    * @property int $id
    * @property int $nutrition_id
    */
class Meal extends Model
{
    use Notifiable;
    protected $fillable=['nutrition_id'];
}
