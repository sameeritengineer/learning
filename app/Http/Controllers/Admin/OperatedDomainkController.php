<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OperatedDomain;
use Illuminate\Support\Facades\Storage;

class OperatedDomainkController extends Controller
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
        $operatedDomain = OperatedDomain::create($request->only(['title', 'description']));

        // Handle file uploads
        if ($request->hasFile('logos')) {
            $logos = [];
            foreach ($request->file('logos') as $logo) {
                $logos[] = $logo->store('logos', 'public'); // Store in public storage
            }
            $operatedDomain->update(['logos' => json_encode($logos)]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified past work.
     */
    public function edit($id)
    {
        $operatedDomain = OperatedDomain::findOrFail($id);
        return response()->json($operatedDomain);
    }

    /**
     * Update the specified past work in storage.
     */
    public function update(Request $request, $id)
    {
        $operatedDomain = OperatedDomain::findOrFail($id);
        $operatedDomain->fill($request->only(['title', 'description']));

        $logos = json_decode($operatedDomain->logos, true) ?? []; // Preserve existing logos

        if ($request->hasFile('logos')) {
            foreach ($request->file('logos') as $logo) {
                $logos[] = $logo->store('logos', 'public'); // Store in public storage
            }
        }

        $operatedDomain->logos = json_encode($logos);
        $operatedDomain->save();

        return response()->json([
            'success' => true,
            'data' => $operatedDomain
        ]);
    }

    /**
     * Remove the specified past work from storage.
     */
    public function destroy($id)
    {
        // Find the OperatedDomain entry
        $operatedDomain = OperatedDomain::findOrFail($id);

        // Decode and delete all stored logo images
        if (!empty($operatedDomain->logos)) {
            $logos = json_decode($operatedDomain->logos, true);
            foreach ($logos as $logo) {
                Storage::disk('public')->delete($logo);
            }
        }

        // Delete the database record
        $operatedDomain->delete();

        return response()->json(['success' => true]);
    }

    public function deleteLogo(Request $request, $id)
    {
        $operatedDomain = OperatedDomain::findOrFail($id);
        $logos = json_decode($operatedDomain->logos, true);

        if (($key = array_search($request->logo, $logos)) !== false) {
            // Remove logo file from storage
            Storage::disk('public')->delete($request->logo);
            
            // Remove from array and update the record
            unset($logos[$key]);
            $operatedDomain->update(['logos' => json_encode(array_values($logos))]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Logo not found']);
    }


}