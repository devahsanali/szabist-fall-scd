<?php
namespace App\Services;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class TeacherService
{
    /**
     * Get all teachers.
     */
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    /**
     * Create a new teacher.
     */
    public function createTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:teachers',
            'phone' => 'required',
        ]);

        try {
            Teacher::create($request->all());
            return ['success' => true, 'message' => 'Teacher created successfully!'];
        } catch (\Exception $e) {
            Log::error('Teacher creation failed: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
        }
    }

    /**
     * Edit a new teacher.
     */
    public function editTeacher($id)
    {
        return  Teacher::findOrFail($id);
    }

    /**
     * Update a teacher's information.
     */
    public function updateTeacher(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            Rule::unique('teachers')->ignore($request->id),
            'phone' => 'required',
        ]);

        $teacher = Teacher::findOrFail($request->id);

        if ($teacher) {
            try {
                $teacher->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);
                return ['success' => true, 'message' => 'Teacher updated successfully!'];
            } catch (\Exception $e) {
                Log::error('Update Failed. ' . $e->getMessage());
                return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
            }
        }

        return ['success' => false, 'message' => 'Invalid Teacher ID'];
    }

    /**
     * Delete a teacher.
     */
    public function deleteTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);

        try {
            $teacher->delete();
            return ['success' => true, 'message' => 'Teacher deleted successfully!'];
        } catch (\Exception $e) {
            Log::error('Delete operation failed. ' . $e->getMessage());
            return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
        }
    }
}
