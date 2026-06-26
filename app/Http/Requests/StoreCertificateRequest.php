<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCertificateRequest extends FormRequest
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
            'organizer' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'training_hours' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'format' => ['nullable', 'string', Rule::in(['ออนไลน์', 'ในสถานที่'])],
            'description' => ['nullable', 'string', 'max:5000'],
            'file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'title.required' => 'กรุณากรอกชื่อหลักสูตร/การอบรม',
            'end_date.after_or_equal' => 'วันสิ้นสุดต้องไม่ก่อนวันเริ่มอบรม',
            'file.mimes' => 'รองรับเฉพาะไฟล์ PDF, JPG หรือ PNG',
            'file.max' => 'ขนาดไฟล์ต้องไม่เกิน 10 MB',
        ];
    }
}
