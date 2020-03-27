<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
        switch ($this->method()){
            // CREATE
            case 'POST':{
                return [
                    'content' => 'required|min:3'
                ];
            }
            case 'DELETE':
            default:{
                return  [];
            }
        }
    }

    public function messages()
    {
        return [
            'content.min' => '标题必须至少三个字符'
        ];
    }
}
