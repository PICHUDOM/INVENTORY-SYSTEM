<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientRe extends Model
{
    use HasFactory;
    protected $table = 'inv_product_ingredient';
    public $timestamps = false;
    protected $primaryKey = 'IPI_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'Pro_id',
        'IIQ_id',
        'status'
    ];
}
