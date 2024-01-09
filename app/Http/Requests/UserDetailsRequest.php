<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;   

use App\Models\UserDetail;

class UserDetailsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // UserDetails.storeとUsersDetails.updateのバリデーション
            'nickname' => 'required|max:50',
            'age' => 'required|numeric',
            'occupation' => 'required|max:50',
            'business_area' => 'required|max:50',
        ];
    }
}
