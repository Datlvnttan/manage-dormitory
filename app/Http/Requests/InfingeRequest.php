<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfingeRequest extends FailedReturnJsonFormRequest
{   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'NoiDung' => 'required',
            'MucDoNghiemTrong' => 'required|numeric|min:1|max:10',
        ];
    }
    public function messages(): array
    {
        return [
            'NoiDung.required' => 'Nội dung vi phạm không được để trống',          
            'MucDoNghiemTrong.required' => 'Mưc độ nghiêm trọng không được để trống',            
            'MucDoNghiemTrong.numeric' => 'Mưc độ nghiêm trọng phải là kiểu số nguyên',            
            'MucDoNghiemTrong.min' => 'Mưc độ nghiêm trọng tối thiểu là 1',            
            'MucDoNghiemTrong.max' => 'Mưc độ nghiêm trọng tối đa là 10',            
        ];
    }  
}
