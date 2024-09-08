<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfingeHistoryRequest extends FailedReturnJsonFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'MaSV' => 'required',
            'MaViPham' => 'required',
            'HinhPhat' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'MaSV.required' => 'Mã sinh viên không được để trống',          
            'MaViPham.required' => 'Mã vi phạm không được để trống',
            'HinhPhat.required' => 'Hình phạt không được để trống',
        ];
    }  
}
