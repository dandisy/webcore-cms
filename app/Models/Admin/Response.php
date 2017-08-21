<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Response
 * @package App\Models
 * @version June 14, 2017, 11:30 pm UTC
 */
class Response extends Model
{
    use SoftDeletes;

    public $table = 'responses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nomor',
        'tanggal',
        'nomor_keberatan',
        'keterangan',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nomor' => 'string',
        'tanggal' => 'date',
        'nomor_keberatan' => 'string',
        'keterangan' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nomor' => 'required',
        'tanggal' => 'required',
        'nomor_keberatan' => 'required',
        'keterangan' => 'required'
    ];

    
}
