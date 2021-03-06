<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTodoRequest extends FormRequest
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
            "title" => "string",
            "description" => "string",
            "complete"=>"boolean"
            //
        ];
    }
    public function messages()
    {
        return [
            'title.string' => 'A title must be string',
            'description.string' => 'desccription must be string',
            'complete.boolean' => 'complete must be bollean',
        ];
    }
}
