<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transactions;
use App\Models\Numbers;
/**
 * Class Operators
 * @package App\Models
 * @version August 31, 2022, 2:26 pm UTC
 *
 * @property string $name
 * @property string $options
 * @property string $address
 * @property string $image
 */
class Operators extends Model
{
    use SoftDeletes;

    public $table = 'operators';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'options',
        'address',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'options' => 'string',
        'address' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'options' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'image' => 'nullable|string|max:255',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'provider_id');
    }

    public function numbers()
    {
        return $this->hasMany(Numbers::class);
    }
}
