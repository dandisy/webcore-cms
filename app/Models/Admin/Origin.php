<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Origin
 * @package App\Models\Admin
 * @version August 1, 2017, 12:32 am UTC
 */
class Origin extends Model
{
    use SoftDeletes;

    public $table = 'origins';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'sub',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'sub' => 'string',
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
