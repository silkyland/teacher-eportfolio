<?php

namespace App\Http\Controllers;

use App\Enums\AwardLevel;
use App\Http\Requests\StoreAwardRequest;
use App\Http\Requests\UpdateAwardRequest;
use App\Models\Award;
use App\Support\AttachmentHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AwardController extends Controller
{
    public function index(Request $request): View
    {
        $query = $request->user()->awards()->latest();

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('awarding_organization', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($year = $request->input('year')) {
            $query->whereYear('award_date', $year);
        }

        if ($level = $request->input('level')) {
            $query->where('level', $level);
        }

        $awards = $query->paginate(10)->withQueryString();
        $levels = AwardLevel::options();
        $years = $request->user()->awards()
            ->selectRaw('DISTINCT YEAR(award_date) as year')
            ->orderByDesc('year')
            ->pluck('year')
            ->filter();

        return view('awards.index', compact('awards', 'levels', 'years'));
    }

    public function create(): View
    {
        $levels = AwardLevel::options();

        return view('awards.create', compact('levels'));
    }

    public function store(StoreAwardRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['file']);
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('file')) {
            $data = array_merge($data, AttachmentHelper::store($request->file('file'), 'awards', $request->user()->id));
        }

        Award::create($data);

        return redirect()->route('awards.index')->with('success', 'บันทึกรางวัลเรียบร้อยแล้ว');
    }

    public function show(Award $award): View
    {
        $this->authorize('view', $award);

        return view('awards.show', compact('award'));
    }

    public function edit(Award $award): View
    {
        $this->authorize('update', $award);
        $levels = AwardLevel::options();

        return view('awards.edit', compact('award', 'levels'));
    }

    public function update(UpdateAwardRequest $request, Award $award): RedirectResponse
    {
        $this->authorize('update', $award);

        $data = $request->safe()->except(['file', 'remove_file']);

        if ($request->boolean('remove_file') && $award->file_path) {
            AttachmentHelper::delete($award->file_path);
            $data['file_path'] = null;
            $data['original_name'] = null;
        }

        if ($request->hasFile('file')) {
            AttachmentHelper::delete($award->file_path);
            $data = array_merge($data, AttachmentHelper::store($request->file('file'), 'awards', $request->user()->id));
        }

        $award->update($data);

        return redirect()->route('awards.index')->with('success', 'อัปเดตรางวัลเรียบร้อยแล้ว');
    }

    public function destroy(Award $award): RedirectResponse
    {
        $this->authorize('delete', $award);

        AttachmentHelper::delete($award->file_path);

        $award->delete();

        return redirect()->route('awards.index')->with('success', 'ลบรางวัลเรียบร้อยแล้ว');
    }
}
