<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostCreateRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'title.min' => 'A title must be at least 6 characters long',
            'title.max' => 'A title must not be more than 25 characters long',
            'body.required'  => 'A body is required',
            'tags' => 'A tag is required',
            'tags.min' => 'You must enter at least one tag',
            'tags.max' => 'Maximum 50 tags allowed',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:6|max:25',
            'body' => 'required',
            'tags' => 'required|min:1|max:50'
        ];
    }

    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()->getMessages()], 422)); 
    }
}
