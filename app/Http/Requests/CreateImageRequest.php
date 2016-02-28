<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateImageRequest extends Request
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
        return [
            // max: 32mb
            'image' => 'required | mimes:jpeg,jpg,bmp,png | max:32000',
            'description' => 'max:255'
        ];
    }
}
