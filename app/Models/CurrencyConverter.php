<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyConverter extends Model
{
    use HasFactory;

    protected $table = 'currency_converters';

    protected $fillable = [
        'currency_value',
        'currency_to',
        'currency_from',
        'currency_converter_value',
    ];
}
