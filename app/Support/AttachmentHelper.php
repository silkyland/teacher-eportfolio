<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AttachmentHelper
{
    public static function store(UploadedFile $file, string $directory, int $userId): array
    {
        return [
            'file_path' => $file->store("{$directory}/{$userId}", 'public'),
            'original_name' => $file->getClientOriginalName(),
        ];
    }

    public static function delete(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
