<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Exception
 * @package App\Models
 * @version June 14, 2017, 11:30 pm UTC
 */
class Exception extends Model
{
    use SoftDeletes;

    public $table = 'exceptions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nomor',
        'tanggal',
        'nomor_permohonan',
        'keterangan',
        'verified',
        'verified_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nomor' => 'string',
        'tanggal' => 'date',
        'nomor_permohonan' => 'string',
        'keterangan' => 'string',
        'verified' => 'integer',
        'verified_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nomor' => 'required',
        'tanggal' => 'required',
        'nomor_permohonan' => 'required',
        'keterangan' => 'required'
    ];

    
}
