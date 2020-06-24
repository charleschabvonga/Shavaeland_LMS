<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceivingsRequest extends FormRequest
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
            'project_number_id' => 'required',
            'warehouse_id' => 'required',
            'client_id' => 'required',
            'received_by_id' => 'required',
            'rate' => 'numeric',
            'days' => 'numeric',
            'total_area_coverd' => 'numeric|required',
            'total_amount' => 'numeric',
            'received_items.*.qty' => 'numeric',
            'received_items.*.area' => 'numeric',
        ];
    }
}
