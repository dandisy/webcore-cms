<?php

namespace App\Repositories;

use App\Models\Page;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PageRepository
 * @package App\Repositories
 * @version January 1, 2018, 4:18 pm UTC
 *
 * @method Page findWithoutFail($id, $columns = ['*'])
 * @method Page find($id, $columns = ['*'])
 * @method Page first($columns = ['*'])
*/
class PageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'title',
        'slug',
        'tag',
        'version',
        'language',
        'template',
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
