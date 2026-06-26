<?php

namespace App\Models;

use App\Enums\AwardLevel;
use Database\Factories\AwardFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[Fillable([
    'user_id',
    'title',
    'awarding_organization',
    'level',
    'award_date',
    'description',
    'file_path',
    'original_name',
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

    public function hasAttachment(): bool
    {
        return filled($this->file_path);
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->hasAttachment()
            ? route('attachments.show', ['type' => 'award', 'id' => $this->id])
            : null;
    }

    public function getDisplayNameAttribute(): ?string
    {
        return $this->original_name ?: ($this->file_path ? basename($this->file_path) : null);
    }

    public function isImage(): bool
    {
        return $this->hasAttachment()
            && in_array(Str::lower(pathinfo($this->file_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true);
    }

    public function getLevelLabelAttribute(): string
    {
        return $this->level?->label() ?? '-';
    }
}
