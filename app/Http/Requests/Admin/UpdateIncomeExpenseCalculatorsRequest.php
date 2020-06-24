<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIncomeExpenseCalculatorsRequest extends FormRequest
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
            
            'distance' => 'numeric',
            'fuel_usage' => 'numeric',
            'fuel_consumption' => 'numeric',
            'oil_usage' => 'numeric',
            'oil_consumption' => 'numeric',
            'number_of_tyres' => 'numeric',
        ];
    }
}
