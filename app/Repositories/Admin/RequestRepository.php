<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Request;
use InfyOm\Generator\Common\BaseRepository;

class RequestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nomor',
        'tanggal',
        'nama_pengguna',
        'nomor_identitas_pengguna',
        'telepon',
        'email',
        'created_by',
        'verified',
        'verified_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Request::class;
    }
}
