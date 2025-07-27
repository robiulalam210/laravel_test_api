<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    // সব ছাত্র দেখাবে
    public function index()
    {
        $students = Student::all();

        return response()->json([
            'success' => true,
            'data' => $students,
            'message' => 'Students retrieved successfully.'
        ], 200);
    }

    // নতুন ছাত্র তৈরি করবে

public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer'
        ]);

        $student = Student::create($request->only(['name', 'email', 'age']));

        return response()->json([
            'success' => true,
            'data' => $student,
            'message' => 'Student created successfully.'
        ], 201);

    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $e->errors() // এতে ফিল্ডভিত্তিক এরর দেখাবে
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Student creation failed due to server error.',
            'error' => $e->getMessage()
        ], 500);
    }
}



    // নির্দিষ্ট ছাত্র দেখাবে
    public function show($id)
    {
        $student = Student::find($id);

        if ($student) {
            return response()->json([
                'success' => true,
                'data' => $student,
                'message' => 'Student retrieved successfully.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Student not found.'
        ], 404);
    }

    // ছাত্র আপডেট করবে
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
            ], 404);
        }

        try {
            $student->update($request->only(['name', 'email', 'age']));

            return response()->json([
                'success' => true,
                'data' => $student,
                'message' => 'Student updated successfully.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Student update failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ছাত্র ডিলিট করবে
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
            ], 404);
        }

        try {
            $student->delete();

            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Student deletion failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
