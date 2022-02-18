<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManagerRequest extends FormRequest
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
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'number' => 'nullable|numeric',
            'national_id' => 'required|numeric',
            'email' => 'required|unique:users,email,{$this->user->id}',
            'password' => 'required|min:8,{$this->user->id}',
            'role_id' => 'integer|size:2',
            'project_id' => 'required|exists:projects,id',
            'supervisor_id' => 'required|exists:users,id',
        ];
    }
}
