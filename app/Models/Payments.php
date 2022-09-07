<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Numbers;
use App\Models\User;

class Payments extends Model
{
    use HasFactory;

    public $table = 'payments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'number_id',
        'user_id',
        'image',
        'status',
        'transaction_number',
        'amount',
        'payment_method'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'number_id' => 'string',
        'user_id' => 'string',
        'image' => 'string',
        'status' => 'string',
        'payment_method' => 'string',
        'transaction_number' => 'string',
        'amount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|string|max:255',
        'number_id' => 'required|string|max:255',
        'image' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'payment_method'    => '|string|max:255',
        'amount' => 'float',
        'transaction_number' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function user()
    {
        return $this->belongsTo(User::class );
    }

    public function number()
    {
        return $this->belongsTo(Numbers::class );
    }
}
