<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseStudy;
use Illuminate\Support\Facades\Storage;

class CaseStudyController extends Controller
{

	public function index()
    {
        $caseStudies = CaseStudy::latest()->paginate(5);
        return view('admin.case_studies.index', compact('caseStudies'));
    }

    public function create()
    {
        return view('admin.case_studies.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'whole_case_study' => 'required|string',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'whole_case_study']);

        if ($request->hasFile('thumbnail_image')) {
            $data['thumbnail_image'] = $request->file('thumbnail_image')->store('case_studies_thumbnails', 'public');
        }

        CaseStudy::create($data);

        return redirect()->route('case-studies.index')->with('success', 'Case Study created successfully!');
    }

    public function edit(CaseStudy $caseStudy)
    {
        return view('admin.case_studies.create-edit', compact('caseStudy'));
    }

    public function update(Request $request, CaseStudy $caseStudy)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'whole_case_study' => 'required|string',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'whole_case_study']);

        if ($request->hasFile('thumbnail_image')) {
            // Delete old image
            if ($caseStudy->thumbnail_image) {
                Storage::disk('public')->delete($caseStudy->thumbnail_image);
            }
            // Upload new image
            $data['thumbnail_image'] = $request->file('thumbnail_image')->store('case_studies_thumbnails', 'public');
        }

        $caseStudy->update($data);

        return redirect()->route('case-studies.index')->with('success', 'Case Study updated successfully!');
    }

    public function destroy(CaseStudy $caseStudy)
    {
        if ($caseStudy->thumbnail_image) {
            Storage::disk('public')->delete($caseStudy->thumbnail_image);
        }

        $caseStudy->delete();

        return redirect()->route('case-studies.index')->with('success', 'Case Study deleted successfully!');
    }

}