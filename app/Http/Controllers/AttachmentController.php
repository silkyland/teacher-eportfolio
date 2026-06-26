<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Certificate;
use App\Models\PortfolioFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttachmentController extends Controller
{
    public function show(Request $request, string $type, int $id): StreamedResponse
    {
        $filePath = match ($type) {
            'certificate' => $this->certificatePath($request, $id),
            'award' => $this->awardPath($request, $id),
            'portfolio' => $this->portfolioPath($request, $id),
            default => abort(404),
        };

        abort_unless(Storage::disk('public')->exists($filePath), 404);

        return Storage::disk('public')->response($filePath);
    }

    private function certificatePath(Request $request, int $id): string
    {
        $certificate = Certificate::query()->findOrFail($id);
        $this->authorize('view', $certificate);
        abort_unless($certificate->file_path, 404);

        return $certificate->file_path;
    }

    private function awardPath(Request $request, int $id): string
    {
        $award = Award::query()->findOrFail($id);
        $this->authorize('view', $award);
        abort_unless($award->file_path, 404);

        return $award->file_path;
    }

    private function portfolioPath(Request $request, int $id): string
    {
        $file = PortfolioFile::query()
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        abort_unless($file->file_path, 404);

        return $file->file_path;
    }
}
