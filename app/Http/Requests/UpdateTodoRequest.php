<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|String",
            "description" => "string",
            //
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'description.string' => 'desccription must be string',
        ];
    }
}
