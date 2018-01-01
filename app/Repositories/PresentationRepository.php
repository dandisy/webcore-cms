<?php

namespace App\Repositories;

use App\Models\Presentation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PresentationRepository
 * @package App\Repositories
 * @version January 1, 2018, 3:51 pm UTC
 *
 * @method Presentation findWithoutFail($id, $columns = ['*'])
 * @method Presentation find($id, $columns = ['*'])
 * @method Presentation first($columns = ['*'])
*/
class PresentationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'component',
        'created_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Presentation::class;
    }
}
