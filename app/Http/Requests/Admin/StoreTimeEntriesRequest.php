<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimeEntriesRequest extends FormRequest
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
            'entry_date' => 'nullable|date_format:'.config('app.date_format'),
            'work_type.*' => 'exists:time_work_types,id',
            'start_time' => 'nullable|date_format:'.config('app.date_format').' H:i:s',
            'end_time' => 'nullable|date_format:'.config('app.date_format').' H:i:s',
        ];
    }
}
