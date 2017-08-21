<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Faq
 * @package App\Models
 * @version June 14, 2017, 11:37 pm UTC
 */
class Faq extends Model
{
    use SoftDeletes;

    public $table = 'faqs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'judul',
        'tanggal',
        'telepon',
        'email',
        'keterangan',
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
        'telepon' => 'string',
        'email' => 'string',
        'keterangan' => 'string',
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
        'email' => 'required',
        'keterangan' => 'required'
    ];

    
}
