<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    // Method index - get all resources
    public function index() 
    {
        // Menggunakan model student untuk select data
        $student = Student::all();

        $data = [
            'message' => 'get all student',
            'data' => $student,
        ];

        // Menggunakan respon json laravel
        // otomatis set header content type json
        // otomatis mengubah data array ke JSON
        // mengatur status code
        return response()->json($data, 200);
    }

    // Menambahkan resource
    public function store(Request $request) 
    {
        // menangkap data request
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];

        // Menggunakan student
        $student = Student::create($input);
        $data = [
            'message' => 'Student is created successfully',
            'data' => $student,
        ];

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }

    # mendapatkan detail resource student
    # membuat method show
    public function show($id)
    {
        # cari data student
        $student = Student::find($id);

        if ($student) {
            $data = [
                'message' => 'Get detail student',
                'data' => $student,
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    # mengupdate resource student
    # membuat method update
    public function update(Request $request, $id)
    {
        # cari data student yg ingin diupdate
        $student = Student::find($id);

        if ($student) {
            # mendapatkan data request
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan,
            ];

            # mengupdate data
            $student->update($input);

            $data = [
                'message' => 'Resource student updated',
                'data' => $student,
            ];

            # mengirimkan respon json dgn status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }
    public function destroy($id)
    {
        # cari data student yg ingin dihapus
        $student = Student::find($id);

        if ($student) {
            # hapus data student
            $student->delete();

            $data = [
                'message' => 'Student is deleted',
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }
}