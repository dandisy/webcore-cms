<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Type
 * @package App\Models\Admin
 * @version July 31, 2017, 11:51 pm UTC
 */
class Type extends Model
{
    use SoftDeletes;

    public $table = 'types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required'
    ];

    
}
