<?php

namespace App\Repositories;

use App\Models\Post;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PostRepository
 * @package App\Repositories
 * @version January 1, 2018, 4:19 pm UTC
 *
 * @method Post findWithoutFail($id, $columns = ['*'])
 * @method Post find($id, $columns = ['*'])
 * @method Post first($columns = ['*'])
*/
class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'title',
        'slug',
        'summary',
        'description',
        'tag',
        'category',
        'cover',
        'version',
        'language',
        'status',
        'created_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Post::class;
    }
}
