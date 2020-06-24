<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleScsRequest extends FormRequest
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
            'make' => 'required',
            'model' => 'required',
            'registration_number' => 'required',
            'certificate_of_fitness_number' => 'required',
            'tracker_pin_details' => 'required',
            'expiration_date' => 'nullable|date_format:'.config('app.date_format'),
        ];
    }
}
