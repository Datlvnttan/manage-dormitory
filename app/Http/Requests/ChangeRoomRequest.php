<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRoomRequest extends FailedReturnJsonFormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tatCa' => 'boolean',
            'thangHienTai' => 'boolean',
            'choXetDuyet' => 'boolean',                     
            'thanhCong' => 'boolean',
            'thatBai' => 'boolean',            
        ];
    }
    // public function messages(): array
    // {
    //     // return [                      
    //     //     'full_name.required' => 'Full name cannot be blank',                
    //     //     'email.required' => 'Email cannot be blank',                
    //     //     'password_confirmation.required' => 'Please re-enter your password',             
    //     //     'email.email' => "The email address is not in the correct format",
    //     //     'password.confirmed' => "The re-entered password does not match",           
    //     // ];
    // }     
}
