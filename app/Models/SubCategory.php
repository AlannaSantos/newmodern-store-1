<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
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

    /* Relacionamento categoria com sub-categoria, necessário para mostrar 
       nome categoria na tabela subcategoria */
    public function category()
    {
        // fk_category_id pertence à table subcategory; 
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
