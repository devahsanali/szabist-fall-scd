<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Course::get();
        return view('course.index',  compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255|unique:courses',
            'credit_hrs' => 'required',
        ]);

        try
        {
            if($validate)
            {
                Course::create($request->all());
                Session::flash('message', 'Course created successfully!');
                Session::flash('alert-class', 'alert-success');
            } else{
                Session::flash('message', 'Error. Validation failed.');
                Session::flash('alert-class', 'alert-danger');
            }
        } catch (\Exception $e)
        {
            Session::flash('message', 'Something went wrong. Please try again later.');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect(route('course.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Course::findOrFail($id);
        return view('course.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'title' => 'required|max:255',
            'credit_hrs' => 'required',
             Rule::unique('Courses')->ignore($request->id),
        ]);

        $data = Course::findOrFail($request->id);
        if($data){
            try
            {
                $data->update([
                    'title' => $request->title,
                    'credit_hrs' => $request->credit_hrs
                ]);
                Session::flash('message', 'Course updated successfully!');
                Session::flash('alert-class', 'alert-success');
            } catch(\Exception $e)
            {
                Log::error('Update Failed. '. $e->getMessage());
                Session::flash('message', 'Something went wrong. Please try again later.');
                Session::flash('alert-class', 'alert-danger');
            }
        } else {
            Session::flash('message', 'Invalid Course ID');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect(route('course.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Course::findOrFail($id);
        try
        {
            $data->delete();
            Session::flash('message', 'Course deleted successfully!');
            Session::flash('alert-class', 'alert-success');

        } catch (\Exception $e)
        {
            Log::error('Delete operation failed. '. $e->getMessage());
            Session::flash('message', 'Something went wrong. Please try again later.');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect(route('course.index'));
    }
}
