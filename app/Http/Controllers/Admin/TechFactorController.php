<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TechFactor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TechFactorController extends Controller
{
    public function index()
    {
        $episodes = TechFactor::latest()->paginate(10);
        return view('admin.tech_factor.index', compact('episodes'));
    }

    public function create()
    {
        $seasons = TechFactor::seasons(); // Fetch static seasons
        return view('admin.tech_factor.create', compact('seasons'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
	        'season' => 'required',
	        'episode_number' => [
	            'required',
	            'integer',
	            Rule::unique('tech_factors')->where(function ($query) use ($request) {
	                return $query->where('season', $request->season);
	            })
	        ],
	        'episode_title' => 'required|string|max:255',
	        'video_link' => 'required|url',
	        'spotify_link' => 'nullable|url',
	        'radio_link' => 'nullable|url',
	        'thumbnail_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
	    ]);

        if ($request->hasFile('thumbnail_image')) {
            $data['thumbnail_image'] = $request->file('thumbnail_image')->store('tech_factor_thumbnails', 'public');
        }

        TechFactor::create($data);
        return redirect()->route('tech-factor.index')->with('success', 'Episode created successfully!');
    }

    public function edit($id)
    {
        $episode = TechFactor::findOrFail($id);
        $seasons = TechFactor::seasons(); // Fetch static seasons
        return view('admin.tech_factor.create', compact('episode', 'seasons'));
    }

    public function update(Request $request, $id)
    {
        $episode = TechFactor::findOrFail($id);

        $data = $request->validate([
            'season'          => 'required|string',
            'episode_title'   => 'required|string|max:255',
            'episode_number'  => 'required|integer',
            'video_link'      => 'required|url',
            'spotify_link'    => 'nullable|url',
            'radio_link'      => 'nullable|url',
            'thumbnail_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail_image')) {
            // Delete the old image
            if ($episode->thumbnail_image) {
                Storage::disk('public')->delete($episode->thumbnail_image);
            }
            $data['thumbnail_image'] = $request->file('thumbnail_image')->store('tech_factor_thumbnails', 'public');
        }

        $episode->update($data);
        return redirect()->route('tech-factor.index')->with('success', 'Episode updated successfully!');
    }

    public function destroy($id)
    {
        $episode = TechFactor::findOrFail($id);
        
        // Delete the image from storage
        if ($episode->thumbnail_image) {
            Storage::disk('public')->delete($episode->thumbnail_image);
        }

        $episode->delete();
        return redirect()->route('tech-factor.index')->with('success', 'Episode deleted successfully!');
    }
}
