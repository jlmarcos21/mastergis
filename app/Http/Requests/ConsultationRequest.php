<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'student_id'    => 'required|integer|exists:students,id',
            'contact_id'    => 'required|integer|exists:contacts,id',
            'course_id'     => 'required|integer|exists:courses,id',
            'interest_id'   => 'required|integer|exists:interests,id',
            'description'   => 'required',
        ];

        return $rules;
    }
}
