<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseStoreRequest extends FormRequest
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
            'name'          => 'required|max:150|unique:courses,name',
            'code'          => 'required|max:100|unique:courses,code',
            'level_id'      => 'required|integer',
            'certificate'   => 'required|string',
            'duration'      => 'required|string|max:120'
        ];

        if($this->hasFile('image'))        
            $rules = array_merge($rules, ['image' => 'image|mimes:jpg,jpeg,png']);

        return $rules;
    }
}
