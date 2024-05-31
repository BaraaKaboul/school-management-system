<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|unique:grades,name->ar'.$this->id, // فائدة $this->id انو لما اعمل edit مايطلعلي مشاكل انو موجودة مسبقا او كذا
            'name_en'=>'required|unique:grades,name->en'.$this->id,
        ];
    }

    public function messages(){

        return [
            'name.required'=>trans('validation.required'),
            'name.unique'=>trans('grades_trans.exist'),

            'name_en.required'=>trans('validation.required'),
            'name_en.unique'=>trans('grades_trans.exist'),
        ];
    }
}
