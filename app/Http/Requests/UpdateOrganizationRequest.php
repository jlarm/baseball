<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
        ];

        // Handle logo validation based on what's sent
        if ($this->hasFile('logo')) {
            $rules['logo'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        } elseif ($this->has('logo') && $this->input('logo') === 'REMOVE') {
            $rules['logo'] = 'in:REMOVE';
        } elseif ($this->has('logo')) {
            // Logo field is present but null - this is valid (no change)
            $rules['logo'] = 'nullable';
        }

        return $rules;
    }
}
