<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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

    /**
     * RELACIONAMENTO CATEGORIA COM PRODUTO; NECESSÁRIO PARA 
     * MOSTRAR ID_CATEGORIA NA PRODUCTS TABLE 
     * 
     */
    public function category()
    {
        // fk_category_id pertence à table subcategory; 
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * RELACIONAMENTO MARCA COM PRODUTO; NECESSÁRIO PARA 
     * MOSTRAR ID_MARCA NA PRODUCTS TABLE
     * 
     */
    public function brand()
    {
        // fk_brand_id pertence à table products; 
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    /**
     * RELACIONAMENTO PRODUTO COM FORNECEDOR
     * 
     */
    public function supplier()
    {
        // fk_fornecedor pertence à table products; 
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
