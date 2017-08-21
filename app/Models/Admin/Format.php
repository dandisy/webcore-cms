<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Format
 * @package App\Models\Admin
 * @version August 1, 2017, 12:06 am UTC
 */
class Format extends Model
{
    use SoftDeletes;

    public $table = 'formats';
    

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
