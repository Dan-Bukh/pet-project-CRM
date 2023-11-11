<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_name' => ['required' ,'string', 'max:50'],
            'email' => ['required' ,'string', 'email', 'max:50'],
            'number' => ['required' ,'string', 'max:15'],
            'comment' => ['required' ,'string', 'max:100'],
            'time' => ['required' ,'string', 'date_format:"Y-m-d H:i:s"', 'max:50'],
        ];
    }
}
