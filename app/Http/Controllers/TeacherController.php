<?php
namespace App\Http\Controllers;

use App\Services\TeacherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function index()
    {
        $data = $this->teacherService->getAllTeachers();
        return view('teacher.index', compact('data'));
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $response = $this->teacherService->createTeacher($request);

        Session::flash('message', $response['message']);
        Session::flash('alert-class', $response['success'] ? 'alert-success' : 'alert-danger');

        return redirect(route('teacher.index'));
    }

    public function edit($id)
    {
        $data = $this->teacherService->editTeacher($id);
        return view('teacher.create', compact('data'));
    }

    public function update(Request $request)
    {
        $response = $this->teacherService->updateTeacher($request);

        Session::flash('message', $response['message']);
        Session::flash('alert-class', $response['success'] ? 'alert-success' : 'alert-danger');

        return redirect(route('teacher.index'));
    }

    public function destroy($id)
    {
        $response = $this->teacherService->deleteTeacher($id);

        Session::flash('message', $response['message']);
        Session::flash('alert-class', $response['success'] ? 'alert-success' : 'alert-danger');

        return redirect(route('teacher.index'));
    }
}
