<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'family' => 'required',
            'phone' => 'required|digits:10|starts_with:9|unique:users',
            'isActive' => 'required|boolean',
            'roleId' => 'required|exists:roles,id',
            'expertId' => 'nullable|exists:experts,id',
        ];

        if ($this->getMethod() == 'PUT') {
            $rules['phone'] = [
                    'required',
                    'digits:10',
                    'starts_with:9',
                    \Illuminate\Validation\Rule::unique('users')->ignore($this->id)
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'phone' => 'شماره همراه',
        ];
    }
}
