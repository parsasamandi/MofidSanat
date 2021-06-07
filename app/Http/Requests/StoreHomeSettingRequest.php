<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomeSettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'about_us_imageSize' => 'Integer|between:1,12',
            'why_us_imageSize' => 'Integer|between:1,12'
        ];
    }
}
