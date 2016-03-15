<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdvancedPersonRequest extends Request {

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
        return [
            'name'                => 'string|max:255',
            'date-of-birth-start' => 'date_format:m/d/Y|on_or_before:date-of-birth-end',
            'date-of-birth-end'   => 'date_format:m/d/Y',
            'date-of-death-start' => 'date_format:m/d/Y|on_or_before:date-of-death-end',
            'date-of-death-end'   => 'date_format:m/d/Y',
            'countries'           => 'array',
            'keyword'             => 'string|max:255',
        ];
    }
}
