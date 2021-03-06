<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentsRequest extends FormRequest
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
            
            'dept_name' => 'required',
            'manager' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'phone_no' => 'required',
            'email' => 'required|email',
        ];
    }
}
