<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTenantRequest extends FormRequest
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
            'first_name' => 'alpha',
            'last_name' => 'alpha',
            'number' => 'nullable|numeric',
            'email' => 'unique:users,email,{$this->user->id}',
            'password' => 'min:8',
            'role_id' => 'integer|size:1',
            'unit_id' => 'exists:units,id',
            'occupation' => 'alpha'
        ];
    }
}
