<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Department $department, Course $course, Request $request)
    {
        $dept = $request->dept ?? 0;
        $level = $request->level ?? 0;
        $sem = $request->sem ?? 0;
        $sess = $request->sess ?? 0;

        $courses = $course->where([
            'dept' => $dept,
            'level' => $level,
            'semester' => $sem,
            'session' => $sess
        ])->get();
        $departments = $department->all();
        return view('courses', compact('departments', 'courses'));
    }

    public function store(Request $request, Course $course)
    {
        try{
            $course->create($request->all());
            return redirect()->back()->with('success', 'Course created successfully');
        } catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
