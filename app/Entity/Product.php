<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
    * @property int $id
    * @property string $name
    * @property string $text
    * @property string $image
    * @property float $proteins
    * @property float $fat
    * @property float $carbohydrates
    */
class Product extends Model
{
    use Notifiable;
    public $timestamps = false;
    protected $fillable = ['name','text','image','proteins','fat','carbohydrates'];
}
