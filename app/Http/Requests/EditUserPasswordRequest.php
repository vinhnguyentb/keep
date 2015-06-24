<?php

namespace Keep\Http\Requests;

class EditUserPasswordRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ];
    }
}
