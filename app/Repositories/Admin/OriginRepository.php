<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Origin;
use InfyOm\Generator\Common\BaseRepository;

class OriginRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'sub',
        'keterangan'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Origin::class;
    }
}
