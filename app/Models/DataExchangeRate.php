<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataExchangeRate extends Model
{

    public $table = 'data_exchange_rate';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'currency_code',
        'date',
        'rate',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'currency_code' => 'string',
        'date' => 'date',
        'rate' => 'double',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rate' => 'required',
        'currency_code' => 'required|unique:data_exchange_rate,date',
        'date' => 'required|unique:data_exchange_rate,currency_code',

    ];


}
