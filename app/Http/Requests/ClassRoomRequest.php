<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoomRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'listClasses.*.class_name_ar' => 'required',
            'listClasses.*.class_name_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'listClasses.*.class_name_ar.required' => trans('validation.class_name_ar.required').'.',
            'listClasses.*.class_name_en.required' => trans('validation.class_name_en.required').'.',
        ];
    }
}
