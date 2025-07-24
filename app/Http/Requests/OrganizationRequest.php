<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class OrganizationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required'],
            'name' => ['required'],
            'logo_path' => ['nullable'],
            'address' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'phone' => ['nullable'],
            'email' => ['nullable', 'email', 'max:254'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
