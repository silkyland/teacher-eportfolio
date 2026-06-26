<?php

namespace App\Http\Controllers;

use App\Enums\AwardLevel;
use App\Models\Award;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $certificateCount = $user->certificates()->count();
        $totalHours = $user->totalTrainingHours();
        $awardCount = $user->awards()->count();

        $awardsByLevel = $user->awards()
            ->select('level', DB::raw('count(*) as total'))
            ->groupBy('level')
            ->get()
            ->mapWithKeys(fn ($row) => [
                ($row->level instanceof AwardLevel ? $row->level : AwardLevel::from($row->level))->label() => $row->total,
            ]);

        $hoursByYear = $user->certificates()
            ->selectRaw('YEAR(COALESCE(end_date, start_date, created_at)) as year, SUM(training_hours) as total_hours')
            ->groupBy('year')
            ->orderBy('year')
            ->get()
            ->mapWithKeys(fn ($row) => [(string) $row->year => (int) $row->total_hours]);

        $recentCertificates = $user->certificates()
            ->with('category')
            ->latest()
            ->limit(5)
            ->get();

        $recentAwards = $user->awards()
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'certificateCount',
            'totalHours',
            'awardCount',
            'awardsByLevel',
            'hoursByYear',
            'recentCertificates',
            'recentAwards',
        ));
    }
}
