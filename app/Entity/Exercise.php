<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
    * @property int $id
    * @property string $name
    * @property string $text
    * @property string $image
    * @property string $muscle
    */
class Exercise extends Model
{
    use Notifiable;
    public $timestamps = false;
    protected $fillable = ['name','text','image'];

    public const MUSCLE_NECK='Neck';
    public const MUSCLE_TRAPEZE='Trapeze';
    public const MUSCLE_SHOULDERS='Shoulders';
    public const MUSCLE_BICEPS='Biceps';
    public const MUSCLE_CHEST='Chest';
    public const MUSCLE_FOREARM='Forearm';
    public const MUSCLE_ABS='Abs';
    public const MUSCLE_QUADRICEPS='Quadriceps';
    public const MUSCLE_TRICEPS='Triceps';
    public const MUSCLE_LATISSIMUS='LATISSIMUS';
    public const MUSCLE_MIDDLE_BACK='Middle back';
    public const MUSCLE_LOWER_BACK='Lower back';
    public const MUSCLE_BUTTOCKS='Buttocks';
    public const MUSCLE_HIPS='Hips';
    public const MUSCLE_CALVES='Calves';
}
