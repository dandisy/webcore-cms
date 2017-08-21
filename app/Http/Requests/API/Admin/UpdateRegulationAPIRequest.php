<?php

namespace App\Http\Requests\API\Admin;

use App\Models\Admin\Regulation;
use InfyOm\Generator\Request\APIRequest;

class UpdateRegulationAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Regulation::$rules;
    }
}
