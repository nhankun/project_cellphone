<?php

namespace App\Http\Requests\Backs\Admins\Managers\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = isset($this->user->id) ? ',id' : '';
        return [
            'name' => 'required|max:255',
            'email'=>'required|unique:users'.$id.'|regex:/^[a-z][a-z0-9_\.]{2,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/|max:255',
            'phone'=>'nullable|regex:/\+.[0-9]{9,12}/|max:12',
            'password' => 'required|min:8',
            'address' => 'nullable|max:255',
        ];
    }
}
