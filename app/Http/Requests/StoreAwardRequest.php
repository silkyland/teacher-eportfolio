<?php

namespace App\Http\Requests;

use App\Enums\AwardLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAwardRequest extends FormRequest
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
            'awarding_organization' => ['nullable', 'string', 'max:255'],
            'level' => ['required', Rule::enum(AwardLevel::class)],
            'award_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:5000'],
            'file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'title.required' => 'กรุณากรอกชื่อรางวัล',
            'level.required' => 'กรุณาเลือกระดับรางวัล',
            'file.mimes' => 'รองรับเฉพาะไฟล์ PDF, JPG หรือ PNG',
            'file.max' => 'ขนาดไฟล์ต้องไม่เกิน 5 MB',
        ];
    }
}
