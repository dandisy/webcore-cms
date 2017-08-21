<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Archive
 * @package App\Models\Admin
 * @version August 1, 2017, 12:02 am UTC
 */
class Archive extends Model
{
    use SoftDeletes;

    public $table = 'archives';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'judul',
        'tanggal',
        'jenis_informasi',
        'asal',
        'bentuk_informasi',
        'keterangan',
        'file',
        'verified',
        'verified_by',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'judul' => 'string',
        'tanggal' => 'date',
        'jenis_informasi' => 'string',
        'asal' => 'string',
        'bentuk_informasi' => 'string',
        'keterangan' => 'string',
        'file' => 'string',
        'verified' => 'string',
        'verified_by' => 'string',
        'created_by' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'judul' => 'required',
        'tanggal' => 'required',
        'jenis_informasi' => 'required',
        'bentuk_informasi' => 'required',
        'keterangan' => 'required'
    ];

    public function origin() {
        return $this->belongsTo('App\Models\Origin', 'asal');
    }

    public function type() {
        return $this->belongsTo('App\Models\Type', 'jenis_informasi');
    }

    public function format() {
        return $this->belongsTo('App\Models\Format', 'bentuk_informasi');
    }
}
