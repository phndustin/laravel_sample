<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
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
            'email'      => 'required_if:tag,null|exists:users',
            'tag'        => 'required_if:email,null|exists:crypto_tags',
            'password'   => 'required',
            'otp'        => 'string',
            'grecaptcha' => 'required',
        ];
    }
}
