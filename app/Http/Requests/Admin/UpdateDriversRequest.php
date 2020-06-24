<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriversRequest extends FormRequest
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
            'name' => 'required',
            'date_of_birth' => 'nullable|date_format:'.config('app.date_format'),
            'drivers_license_number' => 'required',
            'drivers_license_expiry_date' => 'nullable|date_format:'.config('app.date_format'),
            'int_drivers_license_expiry_date' => 'nullable|date_format:'.config('app.date_format'),
            'drivers_passport_number' => 'required',
            'passport_expiry_date' => 'required|date_format:'.config('app.date_format'),
            'sa_phone_number' => 'required',
            'int_phone_number' => 'required',
            'police_clearance_expiry_date' => 'nullable|date_format:'.config('app.date_format'),
            'retest_expiry_date' => 'nullable|date_format:'.config('app.date_format'),
        ];
    }
}
