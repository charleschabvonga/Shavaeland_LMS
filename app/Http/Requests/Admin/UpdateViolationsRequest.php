<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateViolationsRequest extends FormRequest
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
            
            'employee_name_id' => 'required',
            'citation_number' => 'required',
            'citation_date' => 'required|date_format:'.config('app.date_format'),
            'description' => 'required',
        ];
    }
}
