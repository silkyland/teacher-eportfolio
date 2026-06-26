# ระบบจัดเก็บผลงาน เกียรติบัตร และรางวัลครู (Teacher e-Portfolio)

เว็บแอปพลิเคชันสำหรับครูบันทึก จัดเก็บ ค้นหา และส่งออกแฟ้มผลงาน (เกียรติบัตรการอบรม + รางวัล) เพื่อใช้ประกอบการประเมินวิทยฐานะ / ว.PA

## เทคโนโลยี

- Laravel 13 + PHP 8.3
- Laravel Breeze (Blade) + Tailwind CSS
- MySQL 8.4 (Docker)
- barryvdh/laravel-dompdf (ส่งออก PDF)
- Chart.js (กราฟแดชบอร์ด)

## พอร์ต Docker (ไม่ใช่ค่า default)

| บริการ | พอร์ตบนเครื่อง |
|--------|----------------|
| เว็บ (Nginx) | **8088** |
| MySQL | **3308** |

## วิธีติดตั้งและรัน (Docker — แนะนำ)

```bash
cd ~/Sites/teacher-eportfolio

# 1) สร้าง image และรัน containers
docker compose up -d --build

# 2) ติดตั้ง dependencies (ครั้งแรก)
docker compose run --rm --no-deps app composer install
docker compose run --rm --no-deps node sh -c "npm install && npm run build"

# 3) ตั้งค่าแอป
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan storage:link
docker compose exec app php artisan pdf:install-fonts
```

เปิดเบราว์เซอร์: **http://localhost:8088**

### บัญชีทดสอบ

- อีเมล: `teacher@example.com`
- รหัสผ่าน: `password`

## วิธีรันแบบ Local (ไม่ใช้ Docker)

> ต้องมี PHP 8.3+ (พร้อม extensions ครบ), Composer, Node.js, MySQL

```bash
cd ~/Sites/teacher-eportfolio
composer install
cp .env.example .env
php artisan key:generate

# แก้ไข .env ให้ชี้ MySQL ของคุณ
php artisan migrate --seed
php artisan storage:link
php artisan pdf:install-fonts
npm install && npm run build
php artisan serve --port=8088
```

## ฟีเจอร์หลัก

- สมัครสมาชิก / เข้าสู่ระบบ / แก้ไขโปรไฟล์ครู
- CRUD เกียรติบัตรการอบรม (แนบไฟล์ PDF/JPG/PNG)
- CRUD รางวัล (แนบไฟล์)
- ค้นหาและกรองตามปี / หมวดหมู่ / ระดับรางวัล
- แดชบอร์ดสรุปสถิติ + กราฟ Chart.js
- หน้าแฟ้มผลงาน + ส่งออก PDF
- ความเป็นส่วนตัว: ครูแต่ละคนเห็นเฉพาะข้อมูลของตนเอง (Policy + user_id filter)

## คำสั่ง Docker ที่ใช้บ่อย

```bash
# ดู log
docker compose logs -f

# หยุดระบบ
docker compose down

# รัน artisan
docker compose exec app php artisan <command>

# build assets ใหม่
docker compose run --rm --no-deps node npm run build
```

## โครงสร้างเส้นทางหลัก

| URL | คำอธิบาย |
|-----|----------|
| `/dashboard` | แดชบอร์ดสรุปผล |
| `/certificates` | จัดการเกียรติบัตร |
| `/awards` | จัดการรางวัล |
| `/portfolio` | แฟ้มผลงาน |
| `/portfolio/pdf` | ดาวน์โหลด PDF |
| `/profile` | แก้ไขโปรไฟล์ |

## ข้อจำกัด / หมายเหตุ

- ฟีเจอร์ AI อ่านไฟล์เกียรติบัตรอัตโนมัติ **ยังไม่ได้รวมในเวอร์ชันนี้** (ต้องใช้ OCR/API เพิ่มเติม)
- ไฟล์แนบเก็บใน `storage/app/public` ผ่าน Laravel Storage (public disk)
- รองรับอัปโหลดไฟล์ PDF/JPG/PNG สูงสุด **10MB** ที่เกียรติบัตร, รางวัล และหน้าแฟ้มผลงาน
- PDF ใช้ฟอนต์ **TH Sarabun New** ฝังในไฟล์แล้ว — รัน `php artisan pdf:install-fonts` หลัง deploy ทุกครั้ง (หรือรวมในขั้นตอน setup)

## ผู้พัฒนา

สร้างด้วย Laravel + Breeze สำหรับครูไทย — UI ภาษาไทยทั้งหมด โทนสีน้ำเงิน-ฟ้าตัดส้ม
