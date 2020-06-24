<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreClearanceAndForwardingsRequest extends FormRequest
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
            'project_number_id' => 'required',
            'border_post' => 'required',
            'client_id' => 'required',
            'agent_id' => 'required',
            'invoice_items.*.qty' => 'numeric',
        ];
    }
}
