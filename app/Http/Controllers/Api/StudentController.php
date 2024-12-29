<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            $data = [
                "message" => "No students found",
                "status" => 404,
            ];

            return response()->json($data, $data["status"]);
        }

        return response()->json(
            [
                "message" => "Getting all students",
                "status" => 200,
                "data" => $students
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:students",
            "phone" => "required|numeric",
            "language" => "required",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Error at storing student",
                "errors" => $validator->errors(),
                "status" => 400,
            ];

            return response()->json($data, $data["status"]);
        }

        $student = Student::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "language" => $request->language,
        ]);

        if (!$student) {
            $data = [
                "message" => "Failed to create student",
                "status" => 400,
            ];

            return response()->json($data, $data["status"]);
        }

        $data = [
            "message" => "Student created successfully",
            "status" => 201,
        ];

        return response()->json(
            [
                "message" => "Student created successfully",
                "status" => 201,
                "student" => $student,
            ],
            201
        );
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                "message" => "Student not found",
                "status" => 404,
            ];

            return response()->json($data, $data["status"]);
        }

        return response()->json(
            [
                "message" => "Getting student",
                "status" => 200,
                "student" => $student,
            ],
            200
        );
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                "message" => "Student not found",
                "status" => 404,
            ];

            return response()->json($data, $data["status"]);
        }

        // Delete the student
        $student->delete();

        return response()->json(
            [
                "message" => "Student deleted successfully",
                "status" => 200,
            ],
            200
        );
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                "message" => "Student not found",
                "status" => 404,
            ];

            return response()->json($data, $data["status"]);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:students",
            "phone" => "required|numeric",
            "language" => "required",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Error at updating student",
                "errors" => $validator->errors(),
                "status" => 400,
            ];

            return response()->json($data, $data["status"]);
        }

        $student = Student::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "language" => $request->language,
        ]);

        $student->save();

        return response()->json(
            [
                "message" => "Student updated successfully",
                "status" => 200,
                "student" => $student,
            ],
            200
        );
    }
}
