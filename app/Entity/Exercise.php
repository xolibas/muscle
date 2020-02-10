<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
/**
    * @property int $id
    * @property string $name
    * @property string $text
    * @property string $image
    */
class Exercise extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','text','image'];
}
