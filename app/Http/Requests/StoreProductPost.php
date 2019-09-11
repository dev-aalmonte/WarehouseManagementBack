<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductPost extends FormRequest
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
            'name' => 'required|unique:products|max:255',
            'price' => 'required',
            'description' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        $errorArr = ['error' => $errors, 'code' => 422];
        throw new HttpResponseException(response()->json($errorArr, 422));
    }
}
