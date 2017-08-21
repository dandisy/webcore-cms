<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Request
 * @package App\Models
 * @version June 14, 2017, 11:29 pm UTC
 */
class Request extends Model
{
    use SoftDeletes;

    public $table = 'requests';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nomor',
        'tanggal',
        'nama_pengguna',
        'nomor_identitas_pengguna',
        'telepon',
        'email',
        'keterangan',
        'created_by',
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
        'nama_pengguna' => 'string',
        'nomor_identitas_pengguna' => 'string',
        'telepon' => 'string',
        'email' => 'string',
        'keterangan' => 'string',
        'created_by' => 'integer',
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
        'nama_pengguna' => 'required',
        'nomor_identitas_pengguna' => 'required',
        'telepon' => 'required',
        'email' => 'required',
        'keterangan' => 'required'
    ];

    
}
