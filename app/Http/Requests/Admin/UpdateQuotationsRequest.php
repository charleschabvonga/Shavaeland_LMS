<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuotationsRequest extends FormRequest
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
            
            'client_id' => 'required',
            'quotation_number' => 'required|unique:quotations,quotation_number,'.$this->route('quotation'),
            'date' => 'required|date_format:'.config('app.date_format'),
            'due_date' => 'required|date_format:'.config('app.date_format'),
            'vat' => 'numeric',
            'invoice_items.*.qty' => 'numeric',
        ];
    }
}
