<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IssueRequest extends FormRequest
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
            'tenant_id' => 'required|exists:users,id',
            'manager_id' => 'required|exists:users,id',
            'title' => 'required',
            'body' => 'required',
            'status' => ['required', Rule::in(['unanswered', 'unresolved', 'resolved']), ],
            'rating' => 'integer|min:0|max:5',
        ];
    }
}
