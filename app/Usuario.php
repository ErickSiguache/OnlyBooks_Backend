<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Usuario extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'usuarios';

    protected $fillable = ['nombre','apellido','telefono', 
        'email', 'username','password', 'ImgPerfil' ,'token'];
}
