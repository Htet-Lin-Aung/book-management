<?php
namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:customers,email,' . $this->customer->id,
            'password' => 'nullable|string|min:8',
        ];
    }
}
