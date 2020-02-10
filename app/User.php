<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/**
    * @property int $id
    * @property string $name
    * @property string $email
    * @property datetime $email_verified_at
    * @property string $gender
    * @property string role
    */
class User extends Authenticatable
{
    use Notifiable;

    public const GENDER_MAN = 'Man';
    public const GENDER_WOMAN = 'Woman';

    public const ROLE_USER = 'User';
    public const ROLE_ADMIN = 'Admin';
    public const ROLE_TRAINER = 'Trainer';

    protected $fillable = [
        'name', 'email', 'password','role','gender'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isWait(): bool{
        return $this->email_verified_at === null;
    }
    public function isActive(): bool{
        return $this->email_verified_at !== null;
    }
    public function verify(): void
    {
        if(!$this->isWait()){
            throw new \DomainException('User is already verified.');
        }
        $this->update([
            'email_verified_at'=>now(),
        ]);
    }
    public function changeRole($role): void{
        if(!\in_array($role,[self::ROLE_USER, self::ROLE_ADMIN, self::ROLE_TRAINER], true)){
            throw new \InvalidArgumentException('Undefined role "'. $role .'"');
        }
        if($this->role === $role){
            throw new \DomainException('Role is already assigned');
        }
        $this->update(['role'=>$role]);
    }
    public function isAdmin(): bool
    {
     return $this->role === self::ROLE_ADMIN;
    }
    public function isTrainer(): bool
    {
        return $this->role === self::ROLE_TRAINER;
    }
}
