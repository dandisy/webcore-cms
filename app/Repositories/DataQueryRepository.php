<?php

namespace App\Repositories;

use App\Models\DataQuery;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class DataQueryRepository
 * @package App\Repositories
 * @version March 8, 2018, 5:02 pm UTC
 *
 * @method DataQuery findWithoutFail($id, $columns = ['*'])
 * @method DataQuery find($id, $columns = ['*'])
 * @method DataQuery first($columns = ['*'])
*/
class DataQueryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'data_source_id',
        'parent',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DataQuery::class;
    }
}
