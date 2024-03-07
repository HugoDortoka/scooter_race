<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.home', compact('courses'));
    }
    public function show($id)
    {
        $course = Course::insurerById($id);
        return view('admin.courseShow', compact('course'));
    }
    public function showAdd()
    {
        return view('admin.courseAdd');
    }
    public function add(Request $request)
    {
        $course = new Course();
        $course->CIF = $request->input('cif');
        $course->name = $request->input('name');
        $course->address = $request->input('address');
        $course->price_per_course = $request->input('price');
        $course->save();
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
    }
    

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update([
            'CIF' => $request->input('cif'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'price_per_course' => $request->input('price')
        ]);
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
    }

    public function change($id){
        $course = Course::findOrFail($id);
        $course->active = !$course->active;
        $course->save();
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
    }
}
