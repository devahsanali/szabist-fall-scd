<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::with('courses')->get();
        return view('enrollment.index',  compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::get();
        $students = Student::get();
        return view('enrollment.create', compact('courses', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'student_id' => 'required',
            'course_id' => 'required|array',
        ]);

        try
        {
            if($validate)
            {
                foreach ($request->course_id as $courseId) {
                    Enrollment::create([
                        'student_id' => $request->student_id,
                        'course_id' => $courseId,
                    ]);
                }
                Session::flash('message', 'Enrollment created successfully!');
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
        return redirect(route('enrollment.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Enrollment::where('student_id', $id)->get();
        $courses = Course::get();
        $students = Student::get();
        return view('enrollment.create', compact('data', 'students', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'course_id' => 'required|array',
        ]);

        try
        {
            Enrollment::where('student_id', $request->student_id)->delete();
            foreach ($request->course_id as $courseId) {
                Enrollment::create([
                    'student_id' => $request->student_id,
                    'course_id' => $courseId,
                ]);
            }
            Session::flash('message', 'Enrollment updated successfully!');
            Session::flash('alert-class', 'alert-success');
        } catch(\Exception $e)
        {
            Log::error('Update Failed. '. $e->getMessage());
            Session::flash('message', 'Something went wrong. Please try again later.');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect(route('enrollment.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try
        {
            Enrollment::where('student_id', $id)->delete();
            Session::flash('message', 'Enrollment deleted successfully!');
            Session::flash('alert-class', 'alert-success');

        } catch (\Exception $e)
        {
            Log::error('Delete operation failed. '. $e->getMessage());
            Session::flash('message', 'Something went wrong. Please try again later.');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect(route('enrollment.index'));
    }
}
