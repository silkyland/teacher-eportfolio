<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePortfolioFileRequest;
use App\Models\PortfolioFile;
use App\Support\AttachmentHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $certificates = $user->certificates()
            ->with('category')
            ->orderByDesc('end_date')
            ->orderByDesc('start_date')
            ->get();

        $awards = $user->awards()
            ->orderByDesc('award_date')
            ->get();

        $portfolioFiles = $user->portfolioFiles()
            ->latest()
            ->get();

        return view('portfolio.index', compact('user', 'certificates', 'awards', 'portfolioFiles'));
    }

    public function storeFile(StorePortfolioFileRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['file']);
        $data['user_id'] = $request->user()->id;
        $data = array_merge($data, AttachmentHelper::store($request->file('file'), 'portfolio', $request->user()->id));

        PortfolioFile::create($data);

        return redirect()->route('portfolio.index')->with('success', 'อัปโหลดเอกสารแนบเรียบร้อยแล้ว');
    }

    public function destroyFile(Request $request, PortfolioFile $portfolioFile): RedirectResponse
    {
        abort_unless($portfolioFile->user_id === $request->user()->id, 403);

        AttachmentHelper::delete($portfolioFile->file_path);
        $portfolioFile->delete();

        return redirect()->route('portfolio.index')->with('success', 'ลบเอกสารแนบเรียบร้อยแล้ว');
    }

    public function pdf(Request $request): Response
    {
        $user = $request->user();

        $certificates = $user->certificates()
            ->with('category')
            ->orderByDesc('end_date')
            ->get();

        $awards = $user->awards()
            ->orderByDesc('award_date')
            ->get();

        $pdf = Pdf::loadView('portfolio.pdf', compact('user', 'certificates', 'awards'))
            ->setPaper('a4')
            ->setOption('defaultFont', 'thsarabunnew');

        $filename = 'portfolio-'.now()->format('Ymd').'.pdf';

        return $pdf->download($filename);
    }
}
