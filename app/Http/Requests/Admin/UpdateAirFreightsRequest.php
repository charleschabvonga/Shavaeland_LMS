<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAirFreightsRequest extends FormRequest
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
            'client_id' => 'required',
            'airline_or_agent' => 'required',
            'airline_or_agent.*' => 'exists:vendors,id',
            'flight_number' => 'required',
            'route_id' => 'required',
            'load_descriptions.*.qty' => 'numeric',
            'load_descriptions.*.weight_volume' => 'numeric',
        ];
    }
}
