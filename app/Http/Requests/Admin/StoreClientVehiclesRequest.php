<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientVehiclesRequest extends FormRequest
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
            'registration_number' => 'required',
            'vehicle_type' => 'required',
            'make' => 'required',
            'model' => 'required',
            'starting_mileage' => 'numeric',
            'next_service_mileage' => 'numeric',
            'next_service_date' => 'nullable|date_format:'.config('app.date_format'),
        ];
    }
}
