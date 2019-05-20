<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
        $rules = [            
            'name'          => 'required|max:150|unique:students,name',
            'lastname'      => 'required|max:150|unique:students,lastname',
            'sex'           => 'required|in:MASCULINO,FEMENINO',                    
            'country_id'    => 'required|integer',
            'email'         => 'required|max:240|unique:students,email',
            'phone'         => 'max:25'
        ];

        return $rules;
    }
}
