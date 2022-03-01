<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FinancialHistoryRequest extends FormRequest
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
            'invoice_number' => 'required|numeric',
            'payment_method' => 'required',
            'tenant_id' => 'required|exists,tenant_details,id',
            'target_month' => 'required|numeric|max:12|min:1',
            'payment_amount' => 'required',
            'next_payment_due_date' => 'required',
        ];
    }
}
