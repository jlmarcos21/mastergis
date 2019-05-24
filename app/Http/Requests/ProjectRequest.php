<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'assignment_id' => 'required|integer|exists:assignments,id',            
            'sub_level_id'  => 'required|integer|exists:sub_levels,id',
            'description'   => 'required|string',
            'state'         => 'required',
            'date'          => 'required|date',
        ];
    }
}
