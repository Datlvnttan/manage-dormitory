<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FailedReturnJsonFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [            
            'TenThietBi' => 'required',
            'TongSoLuong' => 'required|numeric|min:0',
            // 'BatBuoc' => 'boolean',
            // 'TinhTheoChiSo' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'TenThietBi.required' => 'Tên thiết bị không được để trống',
            'TongSoLuong.required' => 'Tổng số lượng không được để trống',
            'TongSoLuong.numeric' => 'Tổng số lượng phải là chuỗi số',                        
        ];
    }  
}
