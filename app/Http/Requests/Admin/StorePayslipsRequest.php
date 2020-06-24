<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePayslipsRequest extends FormRequest
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
            'date' => 'nullable|date_format:'.config('app.date_format'),
            'starting_date' => 'nullable|date_format:'.config('app.date_format'),
            'ending_date' => 'nullable|date_format:'.config('app.date_format'),
            'account_number_id' => 'required',
            'income_tax' => 'numeric',
            'deduction_items.*.qty' => 'numeric',
            'overtime_and_bonus_items.*.qty' => 'numeric',
        ];
    }
}
