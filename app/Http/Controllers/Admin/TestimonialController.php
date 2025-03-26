<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'user_logo'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'name'         => 'required|string|max:255',
        //     'position'     => 'required|string|max:255',
        //     'description'  => 'required|string',
        // ]);

        $companyLogoPath = $request->file('company_logo')->store('uploads/testimonials', 'public');
        $userLogoPath = $request->file('user_logo')->store('uploads/testimonials', 'public');

        $testimonial = Testimonial::create([
            'company_logo' => $companyLogoPath,
            'user_logo'    => $userLogoPath,
            'name'         => $request->name,
            'position'     => $request->position,
            'testimonial_description'  => $request->description,
        ]);

        return response()->json(['success' => true, 'message' => 'Testimonial added successfully!', 'data' => $testimonial]);
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return response()->json($testimonial);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        // Update fields
        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->testimonial_description = $request->description;

        // Handle image uploads if new images are provided
        if ($request->hasFile('company_logo')) {
            $testimonial->company_logo = $request->file('company_logo')->store('uploads/testimonials', 'public');
        }

        if ($request->hasFile('user_logo')) {
            $testimonial->user_logo = $request->file('user_logo')->store('uploads/testimonials', 'public');
        }

        $testimonial->save();

        return response()->json(['success' => true, 'message' => 'Testimonial updated successfully!', 'data' => $testimonial]);
    }
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        Storage::disk('public')->delete([$testimonial->company_logo, $testimonial->user_logo]);
        $testimonial->delete();
        return response()->json(['success' => true, 'message' => 'Testimonial deleted successfully!']);
    }
}

