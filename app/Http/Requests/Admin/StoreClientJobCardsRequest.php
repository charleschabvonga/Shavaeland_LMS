<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientJobCardsRequest extends FormRequest
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
            'repair_center_id' => 'required',
            'technician' => 'required',
            'technician.*' => 'exists:employees,id',
            'job_card_items.*.price' => 'numeric',
            'job_card_items.*.qty' => 'numeric',
            'job_card_items.*.total' => 'numeric',
        ];
    }
}
