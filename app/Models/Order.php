<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /* protected $guarded substitui o fillable, 
     * é um alternativa execlente pois assim elimina
     * a necessidade de ter que digitar ou copiar e colar toda informação
     * declarada na migrations table
     * 
     */
    protected $guarded = [];

    // Relação c/ usario autenticado
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relação c/ estado envio
    public function division()
    {
        return $this->belongsTo(ShippingDivision::class, 'shipping_division_id', 'id');
    }

    // Relação c/ cidade envio
    public function district()
    {
        return $this->belongsTo(ShippingDistrict::class, 'shipping_district_id', 'id');
    }
}
