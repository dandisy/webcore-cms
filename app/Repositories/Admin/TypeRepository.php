<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Type;
use InfyOm\Generator\Common\BaseRepository;

class TypeRepository extends BaseRepository
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
        return Type::class;
    }
}
