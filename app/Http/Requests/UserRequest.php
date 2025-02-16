<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        // return [
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        //     'city' => ['required', 'string', 'max:255'],
        //     'password' => ['required'],
        //     'address' => ['required', 'string', 'max:255'],
        //     'image' => ['required', 'string', 'max:255'],
        // ];

        // if ($this->isMethod('post')) {
        //     return [
        //         'first_name' => ['required', 'string', 'max:255'],
        //         'last_name' => ['required', 'string', 'max:255'],
        //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        //         'city' => ['required', 'string', 'max:255'],
        //         'password' => ['required'],
        //         'address' => ['required', 'string', 'max:255'],
        //         'image' => ['required', 'string', 'max:255'],
        //     ];
        // }

        // if ($this->isMethod('put')) {
        //     return [
        //         'first_name' => ['required', 'string', 'max:255'],
        //         'last_name' => ['required', 'string', 'max:255'],
        //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        //         'city' => ['required', 'string', 'max:255'],
        //         'address' => ['required', 'string', 'max:255'],
        //     ];
        // }


    }
}
