<?php
namespace App\Http\Controllers\Api;

use App\Services\TeacherService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherApiController extends Controller
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function index()
    {
        $data = $this->teacherService->getAllTeachers();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $response = $this->teacherService->createTeacher($request);
        return response()->json($response);
    }

    public function edit(Request $request)
    {
        $response = $this->teacherService->editTeacher($request->id);
        return response()->json($response);
    }

    public function update(Request $request)
    {
        $response = $this->teacherService->updateTeacher($request);
        return response()->json($response);
    }

    public function destroy($id)
    {
        $response = $this->teacherService->deleteTeacher($id);
        return response()->json($response);
    }
}
