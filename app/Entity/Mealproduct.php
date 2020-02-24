<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
    * @property int $id
    * @property int $meal_id
    * @property int $product_id
    * @property int $weight
    */
class Mealproduct extends Model
{
    use Notifiable;
    protected $fillable = ['meal_id','product_id','weight'];
}
