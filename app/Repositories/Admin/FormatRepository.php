<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Format;
use InfyOm\Generator\Common\BaseRepository;

class FormatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Format::class;
    }
}
