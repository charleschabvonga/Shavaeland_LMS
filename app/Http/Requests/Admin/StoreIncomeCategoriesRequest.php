<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomeCategoriesRequest extends FormRequest
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
            'due_date' => 'nullable|date_format:'.config('app.date_format'),
            'client_id' => 'required',
            'percent_discount' => 'numeric',
            'vat' => 'numeric',
            'invoice_items.*.qty' => 'numeric',
        ];
    }
}
