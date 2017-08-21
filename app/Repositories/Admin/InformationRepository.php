<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Information;
use InfyOm\Generator\Common\BaseRepository;

class InformationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'judul',
        'tanggal',
        'asal',
        'jenis_informasi',
        'bentuk_informasi',
        'keterangan',
        'tag',
        'created_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Information::class;
    }
}
