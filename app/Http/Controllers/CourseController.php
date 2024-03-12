<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    public function index()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $courses = Course::all();
        return view('admin.home', compact('courses'));
    }
    public function show($id)
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $course = Course::insurerById($id);
        return view('admin.courseShow', compact('course'));
    }
    public function showAdd()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        return view('admin.courseAdd');
    }
    public function add(Request $request)
    {
        $course = new Course();
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->elevation = $request->input('elevation');
        $mapImage = $request->file('map_image');
        $mapImageExtension = $mapImage->getClientOriginalExtension();
        $mapImageName = time() . '_' . $request->input('name') . '.' . $mapImageExtension;
        $mapImage->move(public_path('img/map_images'), $mapImageName);
        $mapImagePath = 'img/map_images/' . $mapImageName;
        $course->map_image = $mapImagePath;
        $course->max_participants = $request->input('max_participants');
        $course->distance_km = $request->input('distance_km');
        $course->date = $request->input('date');
        $course->time = $request->input('time');
        $course->location = $request->input('location');
        $promotionPoster = $request->file('promotion_poster');
        $promotionPosterExtension = $promotionPoster->getClientOriginalExtension();
        $promotionPosterName = time() . '_' . $request->input('name') . '.' . $promotionPosterExtension;
        $promotionPoster->move(public_path('img/promotion_posters'), $promotionPosterName);
        $promotionPosterPath = 'img/promotion_posters/' . $promotionPosterName;
        $course->promotion_poster = $promotionPosterPath;
        $course->sponsorship_cost = $request->input('sponsorship_cost');
        $course->registration_price = $request->input('registration_price');
        $course->save();
        return Redirect::route('admin.home');
    }
    

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $dataToUpdate = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'elevation' => $request->input('elevation'),
            'max_participants' => $request->input('max_participants'),
            'distance_km' => $request->input('distance_km'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'location' => $request->input('location'),
            'sponsorship_cost' => $request->input('sponsorship_cost'),
            'registration_price' => $request->input('registration_price')
        ];

        if ($request->hasFile('map_image')) {
            unlink(public_path($course->map_image));
            $map_image = $request->file('map_image');
            $map_imageExtension = $map_image->getClientOriginalExtension();
            $map_imageName = time() . '_' . $request->input('name') . '.' . $map_imageExtension;
            $map_image->move(public_path('img/map_images'), $map_imageName);
            $map_imagePath = 'img/map_images/' . $map_imageName;
            $dataToUpdate['map_image'] = $map_imagePath;
        }

        if ($request->hasFile('promotion_poster')) {
            unlink(public_path($course->promotion_poster));
            $promotion_poster = $request->file('promotion_poster');
            $promotion_posterExtension = $promotion_poster->getClientOriginalExtension();
            $promotion_posterName = time() . '_' . $request->input('name') . '.' . $promotion_posterExtension;
            $promotion_poster->move(public_path('img/promotion_posters'), $promotion_posterName);
            $promotion_posterPath = 'img/promotion_posters/' . $promotion_posterName;
            $dataToUpdate['promotion_poster'] = $promotion_posterPath;
        }

        $course->update($dataToUpdate);
        return Redirect::route('admin.home');
    }

    public function change($id){
        $course = Course::findOrFail($id);
        $course->active = !$course->active;
        $course->save();
        return Redirect::route('admin.home');
    }
}
