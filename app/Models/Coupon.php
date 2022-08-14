<?php

/**
 * PROJETO REAL LUCAS
 * NÃO FAZ PARTE DO PROJETO INTEGRADOR I
 * NÃO FOI DEFINIDO NA DOCUMENTAÇÃO, 
 * PORTANTO, NÃO DEVE SER FALADO NA APRESENTAÇÃO.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /** 
     * protected $guarded substitui o fillable, 
     * é um alternativa execlente pois assim elimina
     * a necessidade de ter que digitar ou copiar 
     * e colar toda informação declarada na migrations table
     * 
     */
    protected $guarded = [];
}
