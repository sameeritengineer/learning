<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PastWork;
use Illuminate\Support\Facades\Storage;

class PastworkController extends Controller
{
    /**
     * Display a listing of the past work.
     */
    public function index()
    {
        $pastworks = PastWork::latest()->get();
        return view('admin.pastwork.index', compact('pastworks'));
    }

    /**
     * Store a newly created past work in storage.
     */
    public function store(Request $request)
    {

        $data = $request->except(['company_logo', 'user_logo']);

        // Handle file uploads
        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('pastwork/company', 'public');
        }

        if ($request->hasFile('user_logo')) {
            $data['user_logo'] = $request->file('user_logo')->store('pastwork/user', 'public');
        }

        PastWork::create($data);

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified past work.
     */
    public function edit($id)
    {
        $pastwork = PastWork::findOrFail($id);
        return response()->json($pastwork);
    }

    /**
     * Update the specified past work in storage.
     */
    public function update(Request $request, $id)
    {
        $pastwork = PastWork::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['company_logo', 'user_logo']);

        // Handle file updates
        if ($request->hasFile('company_logo')) {
            Storage::disk('public')->delete($pastwork->company_logo);
            $data['company_logo'] = $request->file('company_logo')->store('pastwork/company', 'public');
        }

        if ($request->hasFile('user_logo')) {
            Storage::disk('public')->delete($pastwork->user_logo);
            $data['user_logo'] = $request->file('user_logo')->store('pastwork/user', 'public');
        }

        $pastwork->update($data);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified past work from storage.
     */
    public function destroy($id)
    {
        $pastwork = PastWork::findOrFail($id);

        // Delete images from storage
        Storage::disk('public')->delete([$pastwork->company_logo, $pastwork->user_logo]);

        $pastwork->delete();

        return response()->json(['success' => true]);
    }
}