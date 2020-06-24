<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayeePaymentsRequest extends FormRequest
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
            
            'entry_date' => 'required|date_format:'.config('app.date_format'),
            'payslip_number_id' => 'required',
            'payment_mode' => 'required',
            'amount' => 'required',
        ];
    }
}
