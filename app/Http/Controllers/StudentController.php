<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::get();
        return view('student.index',  compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:students',
            'phone' => 'required',
        ]);

        try
        {
            if($validate)
            {
                Student::create($request->all());
                Session::flash('message', 'Student created successfully!');
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
        return redirect(route('student.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Student::findOrFail($id);
        return view('student.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            Rule::unique('students')->ignore($request->id),
            'phone' => 'required',
        ]);

        $data = Student::findOrFail($request->id);
        if($data){
            try
            {
                $data->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address
                ]);
                Session::flash('message', 'Student updated successfully!');
                Session::flash('alert-class', 'alert-success');
            } catch(\Exception $e)
            {
                Log::error('Update Failed. '. $e->getMessage());
                Session::flash('message', 'Something went wrong. Please try again later.');
                Session::flash('alert-class', 'alert-danger');
            }
        } else {
            Session::flash('message', 'Invalid student ID');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect(route('student.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Student::findOrFail($id);
        try
        {
            $data->delete();
            Session::flash('message', 'Student deleted successfully!');
            Session::flash('alert-class', 'alert-success');

        } catch (\Exception $e)
        {
            Log::error('Delete operation failed. '. $e->getMessage());
            Session::flash('message', 'Something went wrong. Please try again later.');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect(route('student.index'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $students = Student::where('name', 'LIKE', '%' . $query . '%')
        ->orWhere('email', 'LIKE', '%' . $query . '%')
        ->get();

        return view('student.search-results', compact('students'));
    }
}
