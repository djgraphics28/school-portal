<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return Inertia::render('Courses/Index', [
            'courses' => Course::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Course::create($request->all());

        return redirect()->back()->with('success', 'Course added successfully.');
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $course->update($request->all());

        return redirect()->back()->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }
}
