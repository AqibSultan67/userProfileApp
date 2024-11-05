<?php

namespace App\Http\Controllers;


use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function create()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg|max:2048',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $submission = new Submission();
        $submission->user_id = Auth::id();
        $submission->name = $request->name;
        $submission->contact = $request->contact;

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $submission->profile_image = $imagePath;
        }

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('files', 'public');
            $submission->file = $filePath;
        }

        $submission->save();

        return redirect()->route('submission.show', $submission->id);
    }

    public function show($id)
    {
        $submission = Submission::find($id);

        if (!$submission) {
            return view('show', ['noData' => true]);
        }

        return view('show', compact('submission'));
    }
    public function edit($id)
    {
        $submission = Submission::findOrFail($id);
        return view('submission.edit', compact('submission'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'profile_image' => 'nullable|mimes:jpg,jpeg|max:2048',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $submission = Submission::findOrFail($id);
        $submission->name = $request->name;
        $submission->contact = $request->contact;
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image')->store('profile_images', 'public');
            $submission->profile_image = $profileImage;
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('files', 'public');
            $submission->file = $file;
        }

        $submission->save();

        return redirect()->route('submission.show', $submission->id)->with('success', 'Submission updated successfully.');
    }
    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);
        if ($submission->profile_image) {
            Storage::disk('public')->delete($submission->profile_image);
        }

        if ($submission->file) {
            Storage::disk('public')->delete($submission->file);
        }
        $submission->delete();
        return redirect()->route('home')->with('success', 'Submission deleted successfully.');
    }

}

