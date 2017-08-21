<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Page;
use InfyOm\Generator\Common\BaseRepository;

class PageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'slug',
        'tag',
        'status',
        'created_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Page::class;
    }
}
