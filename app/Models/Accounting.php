<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    protected $table = 'inv_account';
    public $timestamps = false;
    protected $primaryKey = 'IA_id';
    public $incrementing = true;
    protected $keyType = 'int'; 
    protected $fillable = [
        'type',
        'price',
        'Currency_id',
        'date'
    ];
}
