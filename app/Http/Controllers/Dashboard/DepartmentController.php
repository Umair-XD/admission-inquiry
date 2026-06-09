<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('courses')->with('courses')->get();

        return view('dashboard.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        Department::create(['name' => $request->name]);

        return back()->with('success', 'Department created successfully.');
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,'.$department->id,
        ]);

        $department->update(['name' => $request->name]);

        return back()->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return back()->with('success', 'Department deleted successfully.');
    }

    // ── Courses ─────────────────────────────────────────────────────────────

    public function storeCourse(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:courses,name,NULL,id,department_id,'.$department->id,
        ]);

        $department->courses()->create(['name' => $request->name]);

        return back()->with('success', 'Course added successfully.');
    }

    public function updateCourse(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $course->update(['name' => $request->name]);

        return back()->with('success', 'Course updated successfully.');
    }

    public function destroyCourse(Course $course)
    {
        $course->delete();

        return back()->with('success', 'Course deleted successfully.');
    }
}
