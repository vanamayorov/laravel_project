<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderConfirmRequest extends FormRequest
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
            'name' => 'required|min:5|max:255',
            'phone' => 'required|min:10|max:255',
        ];
    }
    public function messages(){
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Минимальное количество символов: :min',
        ];
    }
}
