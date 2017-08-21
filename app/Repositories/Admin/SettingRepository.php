<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Setting;
use InfyOm\Generator\Common\BaseRepository;

class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'value',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }
}
