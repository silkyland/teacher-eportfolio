<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Models\Category;
use App\Models\Certificate;
use App\Support\AttachmentHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function index(Request $request): View
    {
        $query = $request->user()
            ->certificates()
            ->with('category')
            ->latest();

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('organizer', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($year = $request->input('year')) {
            $query->where(function ($q) use ($year) {
                $q->whereYear('start_date', $year)
                    ->orWhereYear('end_date', $year);
            });
        }

        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        $certificates = $query->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $years = $request->user()->certificates()
            ->selectRaw('DISTINCT YEAR(COALESCE(end_date, start_date, created_at)) as year')
            ->orderByDesc('year')
            ->pluck('year')
            ->filter();

        return view('certificates.index', compact('certificates', 'categories', 'years'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('certificates.create', compact('categories'));
    }

    public function store(StoreCertificateRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['file']);
        $data['user_id'] = $request->user()->id;
        $data['training_hours'] = $data['training_hours'] ?? 0;

        if ($request->hasFile('file')) {
            $data = array_merge($data, AttachmentHelper::store($request->file('file'), 'certificates', $request->user()->id));
        }

        Certificate::create($data);

        return redirect()->route('certificates.index')->with('success', 'บันทึกเกียรติบัตรเรียบร้อยแล้ว');
    }

    public function show(Certificate $certificate): View
    {
        $this->authorize('view', $certificate);
        $certificate->load('category');

        return view('certificates.show', compact('certificate'));
    }

    public function edit(Certificate $certificate): View
    {
        $this->authorize('update', $certificate);
        $categories = Category::orderBy('name')->get();

        return view('certificates.edit', compact('certificate', 'categories'));
    }

    public function update(UpdateCertificateRequest $request, Certificate $certificate): RedirectResponse
    {
        $this->authorize('update', $certificate);

        $data = $request->safe()->except(['file', 'remove_file']);

        if ($request->boolean('remove_file') && $certificate->file_path) {
            AttachmentHelper::delete($certificate->file_path);
            $data['file_path'] = null;
            $data['original_name'] = null;
        }

        if ($request->hasFile('file')) {
            AttachmentHelper::delete($certificate->file_path);
            $data = array_merge($data, AttachmentHelper::store($request->file('file'), 'certificates', $request->user()->id));
        }

        $certificate->update($data);

        return redirect()->route('certificates.index')->with('success', 'อัปเดตเกียรติบัตรเรียบร้อยแล้ว');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        $this->authorize('delete', $certificate);

        AttachmentHelper::delete($certificate->file_path);

        $certificate->delete();

        return redirect()->route('certificates.index')->with('success', 'ลบเกียรติบัตรเรียบร้อยแล้ว');
    }
}
