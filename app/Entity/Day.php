<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
    * @property int $id
    * @property int $program_id
    */
class Day extends Model
{
    use Notifiable;
    protected $fillable=['program_id'];
}
