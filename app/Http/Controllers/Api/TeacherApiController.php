<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Services\TeacherService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class TeacherApiController extends Controller
{
    /**
     * @var TeacherService
     */
    protected TeacherService $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    /**
     * Get all teachers.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->teacherService->getAllTeachers();
        return ApiResponseHelper::success('Teachers retrieved successfully', $data);
    }

    /**
     * Create a new teacher.
     *
     * @param StoreTeacherRequest $request
     * @return JsonResponse
     */
    public function store(StoreTeacherRequest $request): JsonResponse
    {
        $response = $this->teacherService->createTeacher($request);
        return ApiResponseHelper::success($response['message']);
    }

    /**
     * Get teacher by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        try {
            $teacher = $this->teacherService->getTeacherById($id);
            return ApiResponseHelper::success('Teacher retrieved successfully', $teacher);
        } catch (ModelNotFoundException $e) {
            return ApiResponseHelper::error('Teacher not found', 404);
        } catch (\Exception $e) {
            return ApiResponseHelper::error('An unexpected error occurred', 500);
        }
    }

    /**
     * Update a teacher's information.
     *
     * @param UpdateTeacherRequest $request
     * @return JsonResponse
     */
    public function update(UpdateTeacherRequest $request): JsonResponse
    {
        try {
            $response = $this->teacherService->updateTeacher($request);
            return ApiResponseHelper::success($response['message']);
        } catch (\Exception $e) {
            return ApiResponseHelper::error($e->getMessage(), 500);
        }
    }

    /**
     * Delete a teacher.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $response = $this->teacherService->deleteTeacher($id);
            return ApiResponseHelper::success($response['message']);
        } catch (ModelNotFoundException $e) {
            return ApiResponseHelper::error('Teacher not found', 404);
        } catch (\Exception $e) {
            return ApiResponseHelper::error('An unexpected error occurred', 500);
        }
    }
}
