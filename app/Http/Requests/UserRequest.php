<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        if(request('role_id') == 1){
            return [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'phone' => 'nullable|numeric',
//                'email' => 'required|unique:users,email,{$this->user->id}',
                'role_id' => 'required|min:1|max:3',
            ];
        } else if(request('role_id') == 2){
            return [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'phone' => 'nullable|numeric',
//                'email' => 'required|unique:users,email,{$this->user->id}',
                'role_id' => 'required|min:1|max:3',
            ];
        } else {
            return [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'phone' => 'nullable|numeric',
//                'email' => 'required|unique:users,email,{$this->user->id}',
                'role_id' => 'required|min:1|max:3',
            ];
        }
    }
}
