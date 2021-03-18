<?php

namespace App\Http\Requests\v2;

use Illuminate\Foundation\Http\FormRequest;

class SocialNetworkRequest extends FormRequest
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
            'data' => [
                'type' => 'required',
                'attributes' => [
                    'type' => 'required|max:128',
                    'url' => 'required|max:256|url',
                ]
            ]            
        ];
    }
}
