<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAparatRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'aparat_url' => 'required|regex:/^https?:\/\/www\.aparat\.com\/video\/video\/embed/',
            'products' => 'required'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'aparat_url' => '"لینک ویدئو امبد آپارات"'
        ];
    }
}
