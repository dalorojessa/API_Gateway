<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'tbllogin';
    // column sa table
    protected $fillable = [
    'email', 'password'
    ];
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $hidden = ['password'];
}