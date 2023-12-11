<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

//*************************************************************
// Rule
//1.  use App\Http\Requests\FailedJobsValidation; //Add Controller
//2.  public function store( FailedJobsValidation $request ){ //example
//*************************************************************

class FailedJobsValidation extends FormRequest
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
				"uuid" => "required", //string('uuid')
				"connection" => "required", //text('connection')
				"queue" => "required", //text('queue')
				"payload" => "required", //longText('payload')
				"exception" => "required", //longText('exception')
				"failed_at" => "required|date_format:Y-m-d H:i:s", //timestamp('failed_at')

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



