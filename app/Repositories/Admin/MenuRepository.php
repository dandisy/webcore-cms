<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Menu;
use InfyOm\Generator\Common\BaseRepository;

class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'label',
        'link',
        'parent',
        'group'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Menu::class;
    }
}
