<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Regulation;
use InfyOm\Generator\Common\BaseRepository;

class RegulationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'judul',
        'status',
        'keterangan',
        'file',
        'created_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Regulation::class;
    }
}
