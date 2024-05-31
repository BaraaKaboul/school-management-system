<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'Email' => 'required|unique:teachers,Email,'.$this->id,
            'Password' => 'required',
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Specialization_id' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required|date|date_format:Y-m-d',
            'Address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Email.required' => trans('teachers_trans.required'),
            'Email.unique' => trans('teachers_trans.unique'),
            'Password.required' => trans('teachers_trans.required'),
            'Name_ar.required' => trans('teachers_trans.required'),
            'Name_en.required' => trans('teachers_trans.required'),
            'Specialization_id.required' => trans('teachers_trans.required'),
            'Gender_id.required' => trans('teachers_trans.required'),
            'Joining_Date.required' => trans('teachers_trans.required'),
            'Address.required' => trans('teachers_trans.required'),
        ];
    }
}
