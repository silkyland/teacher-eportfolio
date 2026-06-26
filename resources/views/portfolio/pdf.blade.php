<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>แฟ้มผลงาน - {{ $user->name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1e293b; }
        h1 { color: #0369a1; margin-bottom: 4px; }
        h2 { color: #0284c7; border-bottom: 2px solid #bae6fd; padding-bottom: 4px; margin-top: 24px; }
        .header { background: #e0f2fe; padding: 16px; border-radius: 8px; margin-bottom: 20px; }
        .meta { margin: 2px 0; }
        .item { border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px; margin-bottom: 8px; }
        .badge { display: inline-block; background: #ffedd5; color: #c2410c; padding: 2px 8px; border-radius: 999px; font-size: 10px; }
        .badge-blue { background: #e0f2fe; color: #0369a1; }
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
            @if($certificate->description)<br><small>{{ $certificate->description }}</small>@endif
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
            @if($award->description)<br><small>{{ $award->description }}</small>@endif
        </div>
    @empty
        <p>ไม่มีข้อมูล</p>
    @endforelse

    <p style="margin-top: 24px; font-size: 10px; color: #64748b;">สร้างเมื่อ {{ now()->format('d/m/Y H:i') }} จากระบบแฟ้มผลงานครู</p>
</body>
</html>
