<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = 
    [
    'nickname', 
    'password',
    'name',
    'email',
    'token',
    'country'
    
    ];

    //  public function membresia()
    //  {
    //      return $this->hasMany('App\Models\Membresia','userid');
    //  }
  
}