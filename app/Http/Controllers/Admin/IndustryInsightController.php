<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndustryInsight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndustryInsightController extends Controller {
    public function index() {
        $insights = IndustryInsight::latest()->paginate(5);
        return view('admin.industry_insights.index', compact('insights'));
    }

    public function create() {
        return view('admin.industry_insights.create_edit');
    }

    public function store(Request $request) {
        $request->validate([
            'pdf_title' => 'required|string|max:255',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_link' => 'required|mimes:pdf|max:10000'
        ]);

        $thumbnailPath = $request->file('thumbnail_image') ? $request->file('thumbnail_image')->store('thumbnails', 'public') : null;
        $pdfPath = $request->file('pdf_link')->store('pdfs', 'public');

        IndustryInsight::create([
            'pdf_title' => $request->pdf_title,
            'thumbnail_image' => $thumbnailPath,
            'pdf_link' => $pdfPath
        ]);

        return redirect()->route('industry-insights.index')->with('success', 'Industry Insight added successfully.');
    }

    public function edit(IndustryInsight $industryInsight) {
        return view('admin.industry_insights.create_edit', compact('industryInsight'));
    }

    public function update(Request $request, IndustryInsight $industryInsight) {
        $request->validate([
            'pdf_title' => 'required|string|max:255',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_link' => 'nullable|mimes:pdf|max:10000'
        ]);

        if ($request->hasFile('thumbnail_image')) {
            Storage::disk('public')->delete($industryInsight->thumbnail_image);
            $industryInsight->thumbnail_image = $request->file('thumbnail_image')->store('thumbnails', 'public');
        }

        if ($request->hasFile('pdf_link')) {
            Storage::disk('public')->delete($industryInsight->pdf_link);
            $industryInsight->pdf_link = $request->file('pdf_link')->store('pdfs', 'public');
        }

        $industryInsight->update($request->only('pdf_title'));

        return redirect()->route('industry-insights.index')->with('success', 'Industry Insight updated successfully.');
    }

    public function destroy(IndustryInsight $industryInsight) {
        Storage::disk('public')->delete([$industryInsight->thumbnail_image, $industryInsight->pdf_link]);
        $industryInsight->delete();
        return back()->with('success', 'Industry Insight deleted successfully.');
    }
}

