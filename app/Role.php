<?php

namespace App;

use Laratrust\LaratrustRole;

class Role extends LaratrustRole
{
    public $fillable = [
        'name',
        'description'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];
}
