<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseOrdersRequest extends FormRequest
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
            
            'vendor_id' => 'required',
            'purchase_order_number' => 'required|unique:purchase_orders,purchase_order_number,'.$this->route('purchase_order'),
            'date' => 'required|date_format:'.config('app.date_format'),
            'request_date' => 'nullable|date_format:'.config('app.date_format'),
            'procurement_date' => 'nullable|date_format:'.config('app.date_format'),
            'vat' => 'numeric',
            'invoice_items.*.qty' => 'numeric',
        ];
    }
}
