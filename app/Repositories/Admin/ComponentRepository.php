<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Component;
use InfyOm\Generator\Common\BaseRepository;

class ComponentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'module'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Component::class;
    }
}
