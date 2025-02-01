<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Subjects/Index', [
            'subjects' => Subject::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:subjects,code',
            'description' => 'nullable',
            'units' => 'required|integer',
        ]);

        Subject::create($request->all());

        return redirect()->back()->with('success', 'Subject added successfully.');
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:subjects,code,' . $subject->id,
            'description' => 'nullable',
            'units' => 'required|integer',
        ]);

        $subject->update($request->all());

        return redirect()->back()->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->back()->with('success', 'Subject deleted successfully.');
    }
}
