<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class StoreStateRequest extends FormRequest
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
            "country_id" => "required|string|exists:countries,id",
            "state_name" => "required|string|max:255|unique:states,state_name,deleted_at,NULL",
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
