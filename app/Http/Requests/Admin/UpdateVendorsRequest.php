<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorsRequest extends FormRequest
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
            
            'name' => 'required',
            'vendor_type' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'email' => 'email',
            'phone_number_1' => 'required',
            'tax_clearance_expiration_date' => 'nullable|date_format:'.config('app.date_format'),
        ];
    }
}
