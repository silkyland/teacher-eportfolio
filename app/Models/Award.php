<?php

namespace App\Models;

use App\Enums\AwardLevel;
use Database\Factories\AwardFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'user_id',
    'title',
    'awarding_organization',
    'level',
    'award_date',
    'description',
    'file_path',
])]
class Award extends Model
{
    /** @use HasFactory<AwardFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'award_date' => 'date',
            'level' => AwardLevel::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? Storage::disk('public')->url($this->file_path) : null;
    }

    public function getLevelLabelAttribute(): string
    {
        return $this->level?->label() ?? '-';
    }
}
