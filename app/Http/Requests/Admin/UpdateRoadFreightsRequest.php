<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoadFreightsRequest extends FormRequest
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
            
            'project_number_id' => 'required',
            'route_id' => 'required',
            'trailers.*' => 'exists:trailers,id',
            'vendor_drivers.*' => 'exists:drivers,id',
            'vendor_vehicles.*' => 'exists:vehicle_scs,id',
            'non_machine_costs.*.qty' => 'numeric',
        ];
    }
}
