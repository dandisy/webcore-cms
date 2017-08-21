<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Archive;
use InfyOm\Generator\Common\BaseRepository;

class ArchiveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'judul',
        'tanggal',
        'jenis_informasi',
        'asal',
        'bentuk_informasi',
        'keterangan'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Archive::class;
    }
}
