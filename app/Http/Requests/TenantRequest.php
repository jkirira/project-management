<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenantRequest extends FormRequest
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
            'national_id' => 'required|numeric',
            'phone' => 'nullable|numeric',
            'email' => 'required|unique:users,email,{$this->user->id}',
            'role_id' => 'integer|size:1',
            'unit_id' => 'required|exists:units,id',
            'occupation' => 'nullable|alpha'
        ];
    }
}
