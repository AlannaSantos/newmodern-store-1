<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /** 
     * protected $guarded substitui o fillable, 
     * é um alternativa execelente pois assim elimina
     * a necessidade de ter que digitar ou copiar e colar toda informação
     * declarada na migrations table
     * 
     */
    protected $guarded = [];
}
