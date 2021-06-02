<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Libro extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'libros';

    protected $fillable = ['tituloLibro','description','categoria', 
        'autores', 'editorial', 'pdf'];
}
