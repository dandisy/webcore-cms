<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Exception;
use InfyOm\Generator\Common\BaseRepository;

class ExceptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nomor',
        'tanggal',
        'nomor_permohonan',
        'keterangan',
        'created_by',
        'verified',
        'verified_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Exception::class;
    }
}
