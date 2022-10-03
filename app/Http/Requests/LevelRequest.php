<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LevelRequest extends FormRequest
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
            'name_ar' => 'required|unique:levels,name->ar,' . $this->id,
            'name_en' => 'required|unique:levels,name->en,' . $this->id
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => trans('validation.level_name_ar.required').'.',
            'name_en.required' => trans('validation.level_name_en.required').'.',
            'name_ar.unique' => trans('validation.level_name_ar.unique').'.',
            'name_en.unique' => trans('validation.level_name_en.unique').'.',
        ];
    }
}
