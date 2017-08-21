<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Information
 * @package App\Models
 * @version June 14, 2017, 11:28 pm UTC
 */
class Information extends Model
{
    use SoftDeletes;

    public $table = 'information';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'judul',
        'tanggal',
        'asal',
        'jenis_informasi',
        'bentuk_informasi',
        'keterangan',
        'tag',
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
        'tanggal' => 'date',
        'asal' => 'string',
        'jenis_informasi' => 'string',
        'bentuk_informasi' => 'string',
        'keterangan' => 'string',
        'tag' => 'string',
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
        'tanggal' => 'required',
        'jenis_informasi' => 'required',
        'bentuk_informasi' => 'required',
        'keterangan' => 'required'
    ];

    public function origin() {
        return $this->belongsTo('App\Models\Origin', 'asal');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category', 'jenis_informasi');
    }

    public function format() {
        return $this->belongsTo('App\Models\Format', 'bentuk_informasi');
    }
}
