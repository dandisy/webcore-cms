<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Regulation
 * @package App\Models
 * @version June 14, 2017, 11:01 pm UTC
 */
class Regulation extends Model
{
    use SoftDeletes;

    public $table = 'regulations';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'judul',
        'status',
        'keterangan',
        'file',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'judul' => 'string',
        'status' => 'string',
        'keterangan' => 'string',
        'file' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'judul' => 'required',
        'status' => 'required',
        'keterangan' => 'required'
    ];

    
}
