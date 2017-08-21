<?php

namespace App;

use Laratrust\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $fillable = [
        'name',
        'display_name',
        'description'
    ];

    /**
     * Validation permissions
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'display_name' => 'required'
    ];
}
