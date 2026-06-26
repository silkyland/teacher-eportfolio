<?php

namespace App\Models;

use Database\Factories\PortfolioFileFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Fillable([
    'user_id',
    'title',
    'description',
    'file_path',
    'original_name',
])]
class PortfolioFile extends Model
{
    /** @use HasFactory<PortfolioFileFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute(): string
    {
        return route('attachments.show', ['type' => 'portfolio', 'id' => $this->id]);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->original_name ?: basename($this->file_path);
    }

    public function isImage(): bool
    {
        return in_array(Str::lower(pathinfo($this->file_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true);
    }

    public function isPdf(): bool
    {
        return Str::lower(pathinfo($this->file_path, PATHINFO_EXTENSION)) === 'pdf';
    }
}
