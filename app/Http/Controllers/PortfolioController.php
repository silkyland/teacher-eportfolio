<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->load([]);

        $certificates = $user->certificates()
            ->with('category')
            ->orderByDesc('end_date')
            ->orderByDesc('start_date')
            ->get();

        $awards = $user->awards()
            ->orderByDesc('award_date')
            ->get();

        return view('portfolio.index', compact('user', 'certificates', 'awards'));
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
            ->setPaper('a4');

        $filename = 'portfolio-'.now()->format('Ymd').'.pdf';

        return $pdf->download($filename);
    }
}
