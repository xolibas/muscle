<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
    * @property int $id
    * @property string $name
    * @property string $text
    * @property string $image
    * @property string $age
    * @property string $gender
    * @property string $requirement
    */
class Nutrition extends Model
{
    use Notifiable;
    protected $fillable = ['name','text','image','age','gender','requirement'];

    public const AGE_CHILDRENS='Childrens';
    public const AGE_OLD_PEOPLE='Old people';
    public const AGE_EVERYBODY='Everybody';
    public const AGE_YOUNG_PEOPLE='Young people';

    public const GENDER_MAN = 'Man';
    public const GENDER_WOMAN = 'Woman';
    public const GENDER_BOTH = 'Both';

    public const REQUIREMENT_WEIGHT_GAIN='Weight gain';
    public const REQUIREMENT_WEIGHT_SUPPORT='Weight support';
    public const REQUIREMENT_WEIGHT_LOSS="Weight loss";
}
