<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Providers;
use App\Models\Transactions;
use App\Models\Numbers;
use App\Models\Countries;


/**
 * Class Numbers
 * @package App\Models
 * @version August 31, 2022, 2:26 pm UTC
 *
 * @property string $name
 * @property string $provider_id
 * @property string $options
 */
class Numbers extends Model
{
    use SoftDeletes;

    public $table = 'numbers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'number',
        'user_id',
        'provider_id',
        'operator_id',
        'country_id',
        'options',
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
        'name' => 'string',
        'user_id' => 'string',
        'provider_id' => 'string',
        'operator_id' => 'string',
        'country_id' => 'string',
        'options' => 'string',
        'payment_method' => 'string',
        'amount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:numbers|string|max:255',
        'user_id' => 'required|string|max:255',
        'provider_id' => 'required|string|max:255',
        'operator_id' => 'required|string|max:255',
        'country_id' => 'required|string|max:255',
        'options'    => '|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];
    public function operator()
    {
        return $this->belongsTo(Operators::class );
    }
    public function payment()
    {
        return $this->belongsTo(Payments::class );
    }
    public function country()
    {
        return $this->belongsTo(Countries::class );
    }
    public function user()
    {
        return $this->belongsTo(User::class );
    }
    

    
}



