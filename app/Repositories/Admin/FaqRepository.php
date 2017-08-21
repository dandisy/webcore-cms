<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Faq;
use InfyOm\Generator\Common\BaseRepository;

class FaqRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'judul',
        'tanggal',
        'telepon',
        'email',
        'keterangan',
        'created_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Faq::class;
    }
}
