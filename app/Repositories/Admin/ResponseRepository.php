<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Response;
use InfyOm\Generator\Common\BaseRepository;

class ResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nomor',
        'tanggal',
        'nomor_keberatan',
        'keterangan',
        'created_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Response::class;
    }
}
