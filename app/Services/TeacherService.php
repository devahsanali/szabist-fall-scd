<?php

namespace App\Services;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class TeacherService
{
    /**
     * Get all teachers.
     *
     * @return Collection
     */
    public function getAllTeachers(): Collection
    {
        return Teacher::all();
    }

    /**
     * Create a new teacher.
     *
     * @param StoreTeacherRequest $request
     * @return array
     */
    public function createTeacher(StoreTeacherRequest $request): array
    {
        try {
            $teacher = Teacher::create($request->validated());

            return [
                'message' => 'Teacher created successfully.',
                'success' => true,
                'data' => $teacher
            ];
        } catch (\Exception $e) {
            Log::error('Error creating teacher: ' . $e->getMessage());

            return [
                'message' => 'An error occurred while creating the teacher.',
                'success' => false
            ];
        }
    }

    /**
     * Get teacher by ID.
     *
     * @param int $id
     * @return Teacher
     * @throws ModelNotFoundException
     */
    public function getTeacherById(int $id): Teacher
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            throw new ModelNotFoundException("Teacher with ID {$id} not found.");
        }

        return $teacher;
    }

    /**
     * Update teacher information.
     *
     * @param UpdateTeacherRequest $request
     * @return array
     */
    public function updateTeacher(UpdateTeacherRequest $request): array
    {
        try {
            $teacher = Teacher::findOrFail($request->id);
            $teacher->update($request->validated());

            return [
                'message' => 'Teacher updated successfully.',
                'success' => true,
                'data' => $teacher
            ];
        } catch (ModelNotFoundException $e) {
            Log::error('Teacher not found: ' . $e->getMessage());

            return [
                'message' => 'Teacher not found.',
                'success' => false
            ];
        } catch (\Exception $e) {
            Log::error('Error updating teacher: ' . $e->getMessage());

            return [
                'message' => 'An error occurred while updating the teacher.',
                'success' => false
            ];
        }
    }

    /**
     * Delete a teacher.
     *
     * @param int $id
     * @return array
     * @throws ModelNotFoundException
     */
    public function deleteTeacher(int $id): array
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            throw new ModelNotFoundException("Teacher with ID {$id} not found.");
        }

        $teacher->delete();

        return [
            'message' => 'Teacher deleted successfully.',
            'success' => true
        ];
    }
}
