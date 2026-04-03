<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('date', 'desc')->get();
        return view('gallery', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'date' => 'required|date',
            'type' => 'required|string',
        ]);

        $path = $request->file('image')->store('gallery_items', 'public');

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
            'date' => $request->date,
            'type' => $request->type,
        ]);

        return back()->with('success', 'Gallery item added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'date' => 'required|date',
            'type' => 'required|string',
        ]);

        $project = Project::findOrFail($id);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'type' => $request->type,
        ];

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('gallery_items', 'public');
        }

        $project->update($data);

        return back()->with('success', 'Gallery item updated successfully!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return back()->with('success', 'Gallery item deleted successfully!');
    }
}
