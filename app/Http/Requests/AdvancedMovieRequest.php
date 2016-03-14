<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdvancedMovieRequest extends Request {

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
            'name'        => 'string|max:255',
            'genre'       => 'array',
            'date-start'  => 'date_format:m/d/Y',
            'date-end'    => 'date_format:m/d/Y',
            'countries'   => 'array',
            'rating'      => 'array',
            'runtime-min' => 'integer',
            'runtime-max' => 'integer',
            'keyword'     => 'string|max:255',
        ];
    }
}
