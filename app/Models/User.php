<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $hidden=['password'];


    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity','amount');
    }
 

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
