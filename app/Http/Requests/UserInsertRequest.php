<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInsertRequest extends FormRequest
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
            'name' => 'required',
            'family' => 'required',
            'phone' => 'required|digits:10|starts_with:9|unique:users',
            'isActive' => 'required|boolean',
            'roleId' => 'required|exists:roles,id',
            'expertId' => 'nullable|exists:experts,id',
        ];
    }

    public function attributes()
    {
        return [
            'phone' => 'شماره همراه',
        ];
    }
}
