<?php

namespace App\Http\Requests\Developer;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'dob' => ['required', 'date', 'before_or_equal:' . Carbon::now()->subYears(15)->format('Y-m-d')],
            'gender' => ['required', 'in:male,female'],
            'designation' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'about' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Get the validation error messages for the defined rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'phone_number.string' => 'The phone number must be a valid string.',
            'phone_number.max' => 'The phone number may not be greater than 15 characters.',

            'gender.required' => 'Please select your gender.',
            'gender.in' => 'The selected gender is invalid.',

            'dob.required' => 'Please enter your date of birth.',
            'dob.date' => 'The date of birth must be a valid date.',
            'dob.before_or_equal' => 'You must be at least 15 years old.',

            'designation.string' => 'The designation must be a valid string.',
            'designation.max' => 'The designation may not be greater than 255 characters.',

            'address.string' => 'The address must be a valid string.',
            'address.max' => 'The address may not be greater than 255 characters.',

            'city.string' => 'The city must be a valid string.',
            'city.max' => 'The city may not be greater than 100 characters.',

            'country.string' => 'The country must be a valid string.',
            'country.max' => 'The country may not be greater than 100 characters.',

            'postal_code.string' => 'The postal code must be a valid string.',
            'postal_code.max' => 'The postal code may not be greater than 10 characters.',

            'about.string' => 'The about section must be a valid string.',
            'about.max' => 'The about section may not be greater than 500 characters.',
        ];
    }
}
