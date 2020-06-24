<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryInstructionsRequest extends FormRequest
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
            'trailers.*' => 'exists:trailers,id',
            'vendor_vehicle_description.*' => 'exists:vehicle_scs,id',
            'client_id' => 'required',
            'delivery_company_name' => 'required',
            'delivery_address_address'=>'required',
            'delivery_address_latitude'=>'required',
            'delivery_address_longitude'=>'required',
            'delivery_date_time' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'load_descriptions.*.qty' => 'numeric',
            'load_descriptions.*.weight_volume' => 'numeric',
        ];
    }
}
