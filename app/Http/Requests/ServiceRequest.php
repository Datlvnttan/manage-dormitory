<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FailedReturnJsonFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'TenDichVu' => 'required',
            'GiaHienTai' => 'required|numeric|min:0',
            // 'BatBuoc' => 'boolean',
            // 'TinhTheoChiSo' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'TenDichVu.required' => 'Tên dịch vụ không được để trống',
            'GiaHienTai.required' => 'Giá dịch vụ không được để trống',
            'GiaHienTai.numeric' => 'Giá dịch vụ phải là chuỗi số',                        
        ];
    }  
}
