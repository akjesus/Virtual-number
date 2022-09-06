<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Numbers;
/**
 * Class Countries
 * @package App\Models
 * @version August 31, 2022, 5:21 pm UTC
 *
 * @property string $iso
 * @property string $name
 * @property string $nicename
 * @property string $iso3
 * @property string $numcode
 * @property string $phonecode
 */
class Countries extends Model
{
    use SoftDeletes;

    public $table = 'countries';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'iso',
        'name',
        'nicename',
        'iso3',
        'numcode',
        'phonecode'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'iso' => 'string',
        'name' => 'string',
        'nicename' => 'string',
        'iso3' => 'string',
        'numcode' => 'string',
        'phonecode' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'iso' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'nicename' => 'required|string|max:255',
        'iso3' => 'nullable|string|max:255',
        'numcode' => 'nullable|string|max:255',
        'phonecode' => 'nullable|string|max:255',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function numbers()
    {
        return $this->hasMany(Numbers::class);
    }
    
}
