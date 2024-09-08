<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FailedReturnJsonFormRequest
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
            'TenDangNhap' => 'required',
            'MatKhau' => 'required|min:3',
            'DangNhapAdmin' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'TenDangNhap.required' => 'Trường đăng nhập không được để trống',
            // 'TenDangNhap.numeric' => 'Mã sinh viên phải là chuỗi số',
            // 'TenDangNhap.min' => 'Mã sinh viên phải đúng 10 ký tự',
            'MatKhau.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'MatKhau.required' => 'Mật khẩu không được để trống',
        ];
    }  
}
