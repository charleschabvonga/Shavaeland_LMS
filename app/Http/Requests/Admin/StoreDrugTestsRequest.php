<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDrugTestsRequest extends FormRequest
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
            'last_annual_drug_test' => 'nullable|date_format:'.config('app.date_format'),
            'last_physical_exam_date' => 'nullable|date_format:'.config('app.date_format'),
        ];
    }
}
