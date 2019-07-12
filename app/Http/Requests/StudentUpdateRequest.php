<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
            'name'          => 'required|max:150',
            'lastname'      => 'required|max:150',
            'sex'           => 'required|in:Masculino,Femenino',                      
            'country_id'    => 'required|integer|exists:countries,id',
            'province_id'   => 'required|integer|exists:provinces,id',
            'email'         => 'required|max:240|unique:students,email,'. $this->student,
            'phone'         => 'max:25'
        ];

        if($this->hasFile('photo'))        
            $rules = array_merge($rules, ['photo' => 'image|mimes:jpg,jpeg,png']);

        return $rules;
    }
}
