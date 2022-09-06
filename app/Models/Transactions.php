<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Providers;
use App\Models\Numbers;

/**
 * Class Transactions
 * @package App\Models
 * @version August 31, 2022, 2:26 pm UTC
 *
 * @property integer $user_id
 * @property integer $phone_id
 * @property integer $provider_id
 * @property string $message
 * @property string $status
 * @property string $payment_method
 * @property number $amount
 */
class Transactions extends Model
{
    use SoftDeletes;

    public $table = 'transactions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'phone_id',
        'operator_id',
        'message',
        'status',
        'payment_method',
        'amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'phone_id' => 'integer',
        'operator_id' => 'integer',
        'message' => 'string',
        'status' => 'string',
        'payment_method' => 'string',
        'amount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'phone_id' => 'required|integer',
        'operator_id' => 'required|integer',
        'message' => 'nullable|string',
        'status' => 'required|string|max:255',
        'payment_method' => 'nullable|string|max:255',
        'amount' => 'required|numeric',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo(Operators::class );
    }

    public function number()
    {
        return $this->belongsTo(Numbers::class );
    }
}
