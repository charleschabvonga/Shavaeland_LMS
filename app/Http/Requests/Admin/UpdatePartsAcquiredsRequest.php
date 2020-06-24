<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartsAcquiredsRequest extends FormRequest
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
            
            'date' => 'required|date_format:'.config('app.date_format'),
            'repair_center_id' => 'required',
            'part_id' => 'required',
            'qty' => 'numeric|required',
        ];
    }
}
