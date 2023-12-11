<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

//*************************************************************
// Rule
//1.  use App\Http\Requests\PersonalAccessTokensValidation; //Add Controller
//2.  public function store( PersonalAccessTokensValidation $request ){ //example
//*************************************************************

class PersonalAccessTokensValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //[ *1. default=false ]
    }
    
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //[ *2. Validation rule description location ]
        return [
				"name" => "required", //string('name')
				"token" => "required|max:64", //string('token',64)
				"abilities" => "nullable", //text('abilities')->nullable()
				"last_used_at" => "nullable|date_format:Y-m-d H:i:s", //timestamp('last_used_at')->nullable()
				"expires_at" => "nullable|date_format:Y-m-d H:i:s", //timestamp('expires_at')->nullable()

            ];
        }
    
        //[ *3. Set Validation message (*Optional) ]
        //Be sure to use [messages] for the Function name.
        //[Ja]https://readouble.com/laravel/6.x/ja/validation-php.html
        public function messages(){
            return [
                //"email.required"  => "メールアドレスを入力してください",
                //"email.max"       => "**文字以下で入力してください",
            ];
        }
    
    }



