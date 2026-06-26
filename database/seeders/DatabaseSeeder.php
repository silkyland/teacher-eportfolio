<?php

namespace Database\Seeders;

use App\Enums\AwardLevel;
use App\Models\Award;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);

        $teacher = User::firstOrCreate(
            ['email' => 'teacher@example.com'],
            [
                'name' => 'ครูสมชาย ใจดี',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'position' => 'ครูชำนาญการ',
                'school' => 'โรงเรียนตัวอย่างอนุบาลศึกษา',
                'subject_group' => 'กลุ่มสาระการเรียนรู้ภาษาไทย',
                'academic_standing' => 'ชำนาญการ',
                'phone' => '081-234-5678',
            ]
        );

        $ict = Category::where('name', 'ICT')->first();
        $academic = Category::where('name', 'วิชาการ')->first();

        Certificate::firstOrCreate(
            ['user_id' => $teacher->id, 'title' => 'หลักสูตรการออกแบบการจัดการเรียนรู้ด้วยเทคโนโลยีดิจิทัล'],
            [
                'organizer' => 'สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน',
                'category_id' => $ict?->id,
                'training_hours' => 15,
                'start_date' => '2024-05-10',
                'end_date' => '2024-05-12',
                'format' => 'ออนไลน์',
                'description' => 'การอบรมเชิงปฏิบัติการด้าน EdTech สำหรับครู',
            ]
        );

        Certificate::firstOrCreate(
            ['user_id' => $teacher->id, 'title' => 'การพัฒนาสื่อการเรียนการสอนเชิงรุก'],
            [
                'organizer' => 'สถานศึกษา',
                'category_id' => $academic?->id,
                'training_hours' => 6,
                'start_date' => '2023-11-01',
                'end_date' => '2023-11-01',
                'format' => 'ในสถานที่',
            ]
        );

        Award::firstOrCreate(
            ['user_id' => $teacher->id, 'title' => 'ครูต้นแบบด้านนวัตกรรมการสอน'],
            [
                'awarding_organization' => 'สำนักงานเขตพื้นที่การศึกษา',
                'level' => AwardLevel::District,
                'award_date' => '2024-03-15',
                'description' => 'รางวัลเชิดชูเกียรติครูที่สร้างสรรค์นวัตกรรมการเรียนการสอน',
            ]
        );

        Award::firstOrCreate(
            ['user_id' => $teacher->id, 'title' => 'รางวัลครูดีเด่นประจำปี'],
            [
                'awarding_organization' => 'โรงเรียนตัวอย่างอนุบาลศึกษา',
                'level' => AwardLevel::School,
                'award_date' => '2023-12-20',
            ]
        );
    }
}
