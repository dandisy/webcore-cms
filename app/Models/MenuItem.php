<?php

namespace App\Models;

use Eloquent as Model;
use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MenuItem
 * @package App\Models
 * @version June 10, 2017, 3:32 pm UTC
 */
class MenuItem extends Model
{
    use SoftDeletes;
    use NestableTrait;

    protected $parent = 'parent';

    public $table = 'menu_items';    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'label',
        'link',
        'parent',
        'sort',
        'class',
        'menu',
        'depth'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'label' => 'string',
        'link' => 'string',
        'parent' => 'integer',
        'sort' => 'integer',
        'class' => 'string',
        'menu' => 'integer',
        'depth' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'label' => 'required',
        'link' => 'required'
    ];

    
}
