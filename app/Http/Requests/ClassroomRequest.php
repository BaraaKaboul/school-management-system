<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            //الList_Classes هي اسم الفورم الي حاملة الarray
            //بهاي الطريقة منعمل فاليديشن لarrays
            'List_Classes.*.class_name'=>'required|unique:classrooms,class_name->ar'.$this->id,
            'List_Classes.*.class_name_en'=>'required|unique:classrooms,class_name->en'.$this->id,
        ];
    }
    public function messages()
    {
        return [
        'class_name.required'=>trans('classes_trans.required'),
        'class_name_en.required'=>trans('classes_trans.required'),
        'class_name.unique'=>trans('classes_trans.unique'),
        'class_name_en.unique'=>trans('classes_trans.unique'),
        ];
    }
}
