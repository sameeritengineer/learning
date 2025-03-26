<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teams = Team::orderBy('id', 'desc')->paginate(10);
        return view('admin.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.team.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'linkedin_link' => 'nullable|url',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->file('image') ? $request->file('image')->store('team_images', 'public') : null;

        // Create new team member
        $team = Team::create([
            'name' => $request->name,
            'position' => $request->position,
            'linkedin_link' => $request->linkedin_link,
            'description' => $request->description,
            'image' => $imagePath, // Store image path in DB
        ]);

        return redirect()->route('team.index')->with('success', 'Team member added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $team = Team::findOrFail($id);

        return view('admin.team.form', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name'          => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'linkedin_link' => 'nullable|url',
            'description'   => 'required|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the team member by ID
        $teamMember = Team::findOrFail($id);

        // Update team member details
        $teamMember->name = $request->name;
        $teamMember->position = $request->position;
        $teamMember->linkedin_link = $request->linkedin_link;
        $teamMember->description = $request->description;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($teamMember->image && Storage::exists('public/team_images/' . $teamMember->image)) {
                Storage::delete('public/team_images/' . $teamMember->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('team_images', 'public');
            $teamMember->image = $imagePath;
        }

        // Save the updated record
        $teamMember->save();

        return redirect()->route('team.index')->with('success', 'Team member updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teamMember = Team::findOrFail($id);

        // Check if the team member has an image and delete it from storage
        if ($teamMember->image && Storage::exists('public/team_images/' . $teamMember->image)) {
                Storage::delete('public/team_images/' . $teamMember->image);
        }

        // Delete the team member record
        $teamMember->delete();

        return redirect()->route('team.index')->with('success', 'Team member deleted successfully!');
    }
}
