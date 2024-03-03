<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:Credit Card Payment,Debit Card Payment,Bank Transfer,PayPal,Cash on Delivery (COD),Mobile Wallet Payment,Cryptocurrency Payment,Check Payment,Direct Debit,Online Banking,Apple Pay,Google Pay',
            'image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'selected_categories' => 'required|array|min:1',
            'selected_categories.*' => 'exists:categories,id',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['image'] = ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048']; // Hace la foto opcional y valida si está presente.
        } else {
            // Si la solicitud es para crear un nuevo recurso, la foto es obligatoria.
            $rules['image'] = ['required', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'];
        }

        return $rules;
    }
}
