<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nume'           => ['required', 'string', 'max:100'],
            'prenume'        => ['nullable', 'string', 'max:100'],
            'telefon'        => ['required', 'string', 'max:20'],
            'email'          => ['nullable', 'email', 'max:200'],
            'tip_apartament' => ['nullable', 'in:1,2,3,4,nedecis'],
            'buget'          => ['nullable', 'in:sub60k,60-90k,90-120k,peste120k,nedecis'],
            'finantare'      => ['nullable', 'in:propriu,credit,prima_casa,nedecis'],
            'mesaj'          => ['nullable', 'string', 'max:2000'],
            'apartament'     => ['nullable', 'string', 'max:200'],
            'gdpr'           => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'nume.required'     => 'Numele este obligatoriu.',
            'telefon.required'  => 'Numărul de telefon este obligatoriu.',
            'gdpr.required'     => 'Trebuie să accepți politica de confidențialitate.',
            'gdpr.accepted'     => 'Trebuie să accepți politica de confidențialitate.',
        ];
    }
}
