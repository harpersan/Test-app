<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = request()->id;
        return [
            'name' => 'required|string|max:255|unique:users,name,'.$user,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user,
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
