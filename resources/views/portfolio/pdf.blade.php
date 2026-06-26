<!DOCTYPE html>
<html lang="th">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>แฟ้มผลงาน - {{ $user->name }}</title>
    <style>
        @page { margin: 24px 28px; }

        body {
            font-family: thsarabunnew, sans-serif;
            font-size: 16px;
            color: #1e293b;
            line-height: 1.35;
        }

        h1 {
            color: #0369a1;
            font-size: 28px;
            font-weight: bold;
            margin: 0 0 6px;
        }

        h2 {
            color: #0284c7;
            font-size: 22px;
            font-weight: bold;
            border-bottom: 2px solid #bae6fd;
            padding-bottom: 4px;
            margin: 22px 0 12px;
        }

        .header {
            background: #e0f2fe;
            padding: 14px 16px;
            margin-bottom: 18px;
        }

        .meta { margin: 2px 0; }

        .item {
            border: 1px solid #e2e8f0;
            padding: 10px 12px;
            margin-bottom: 8px;
        }

        .badge {
            display: inline-block;
            background: #ffedd5;
            color: #c2410c;
            padding: 1px 8px;
            font-size: 14px;
        }

        .badge-blue {
            background: #e0f2fe;
            color: #0369a1;
        }

        .footer {
            margin-top: 24px;
            font-size: 13px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $user->name }}</h1>
        <div class="meta">ตำแหน่ง: {{ $user->position ?? '-' }}</div>
        <div class="meta">สถานศึกษา: {{ $user->school ?? '-' }}</div>
        <div class="meta">กลุ่มสาระ: {{ $user->subject_group ?? '-' }}</div>
        <div class="meta">วิทยฐานะ: {{ $user->academic_standing ?? '-' }}</div>
        <div class="meta">อีเมล: {{ $user->email }} | โทร: {{ $user->phone ?? '-' }}</div>
    </div>

    <h2>เกียรติบัตรการอบรม ({{ $certificates->count() }} รายการ)</h2>
    @forelse ($certificates as $certificate)
        <div class="item">
            <strong>{{ $certificate->title }}</strong><br>
            หน่วยงาน: {{ $certificate->organizer ?? '-' }} |
            ชั่วโมง: {{ $certificate->training_hours }} ชม.
            @if($certificate->category) | <span class="badge badge-blue">{{ $certificate->category->name }}</span> @endif
            @if($certificate->start_date)
                <br>วันที่: {{ $certificate->start_date->format('d/m/Y') }}
                @if($certificate->end_date) - {{ $certificate->end_date->format('d/m/Y') }} @endif
            @endif
            @if($certificate->description)<br>{{ $certificate->description }}@endif
        </div>
    @empty
        <p>ไม่มีข้อมูล</p>
    @endforelse

    <h2>รางวัล ({{ $awards->count() }} รายการ)</h2>
    @forelse ($awards as $award)
        <div class="item">
            <strong>{{ $award->title }}</strong>
            <span class="badge">{{ $award->level_label }}</span><br>
            หน่วยงาน: {{ $award->awarding_organization ?? '-' }}
            @if($award->award_date) | วันที่: {{ $award->award_date->format('d/m/Y') }} @endif
            @if($award->description)<br>{{ $award->description }}@endif
        </div>
    @empty
        <p>ไม่มีข้อมูล</p>
    @endforelse

    <p class="footer">สร้างเมื่อ {{ now()->format('d/m/Y H:i') }} จากระบบแฟ้มผลงานครู</p>
</body>
</html>
