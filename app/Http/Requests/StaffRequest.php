<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'TenDangNhap' => 'required',            
            'Ho' => 'required',
            'Ten' => 'required',
            'ChucVu' => 'required',            
        ];
    }
    public function messages(): array
    {
        return [
            'TenDangNhap.required' => 'Tên đăng nhập không được để trống',                       
            'Ho.required' => 'Họ không được để trống',
            'Ten.required' => 'Tên không được để trống',
            'ChucVu.required' => 'Chức vụ không được để trống',
        ];
    }  
}
