<?php

namespace App\Models;

use Database\Factories\CertificateFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[Fillable([
    'user_id',
    'title',
    'organizer',
    'category_id',
    'training_hours',
    'start_date',
    'end_date',
    'format',
    'description',
    'file_path',
    'original_name',
])]
class Certificate extends Model
{
    /** @use HasFactory<CertificateFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'training_hours' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function hasAttachment(): bool
    {
        return filled($this->file_path);
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->hasAttachment()
            ? route('attachments.show', ['type' => 'certificate', 'id' => $this->id])
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
}
