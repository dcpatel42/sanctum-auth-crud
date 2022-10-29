<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class UpdateCountryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "country_name" => "string|max:255|exists:countries,country_name,".$this->country->id,
            "status"       => "string|in:0,1",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->sendError([
            'data' => $validator->errors()
        ],422));
    }
}
