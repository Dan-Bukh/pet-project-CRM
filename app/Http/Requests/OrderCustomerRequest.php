<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCustomerRequest extends FormRequest
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
            "id" => ['required' ,'string', 'max:40'],
            "supplier_name" => ['required' ,'string', 'max:40'],
            "speciality" => ['required' ,'string', 'max:40'],
            "name" => ['required' ,'string', 'max:40'],
            "email" => ['required' ,'string', 'email', 'max:50'],
            "number" => ['required' ,'string', 'min:5', 'max:15'],
            "time_order" => ['required' ,'string', 'max:10'],
        ];
    }
}
