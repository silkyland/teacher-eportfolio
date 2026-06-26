<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePortfolioFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'title.required' => 'กรุณากรอกชื่อเอกสาร',
            'file.required' => 'กรุณาเลือกไฟล์แนบ',
            'file.mimes' => 'รองรับเฉพาะไฟล์ PDF, JPG หรือ PNG',
            'file.max' => 'ขนาดไฟล์ต้องไม่เกิน 10 MB',
        ];
    }
}
