<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Helpers\WebResponseHelper;
use App\Services\TeacherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeacherController extends Controller
{

    /**
     * @var \App\Services\TeacherService
     */
    protected TeacherService $teacherService;

    /**
     * @var WebResponseHelper
     */
    protected WebResponseHelper $responseHelper;

    /**
     * @param TeacherService $teacherService
     * @param WebResponseHelper $responseHelper
     */
    public function __construct(TeacherService $teacherService, WebResponseHelper $responseHelper)
    {
        $this->teacherService = $teacherService;
        $this->responseHelper = $responseHelper;
    }

    /**
     * Display a listing of the teachers.
     *
     * @return View
     */
    public function index(): View
    {
        $data = $this->teacherService->getAllTeachers();

        return view('teacher.index', compact('data'));
    }

    /**
     * Show the form for creating a new teacher.
     *
     * @return View
     */
    public function create(): View
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created teacher in storage.
     *
     * @param StoreTeacherRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTeacherRequest $request): RedirectResponse
    {
        $response = $this->teacherService->createTeacher($request);

        return $this->responseHelper->flashAndRedirect($response['message'], $response['success'], 'teacher.index');
    }

    /**
     * Show the form for editing the specified teacher.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $data = $this->teacherService->getTeacherById($id);

        return view('teacher.create', compact('data'));
    }

    /**
     * Update the specified teacher in storage.
     *
     * @param UpdateTeacherRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateTeacherRequest $request): RedirectResponse
    {
        $response = $this->teacherService->updateTeacher($request);

        return $this->responseHelper->flashAndRedirect($response['message'], $response['success'], 'teacher.index');
    }

    /**
     * Remove the specified teacher from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $response = $this->teacherService->deleteTeacher($id);

        return $this->responseHelper->flashAndRedirect($response['message'], $response['success'], 'teacher.index');
    }
}
