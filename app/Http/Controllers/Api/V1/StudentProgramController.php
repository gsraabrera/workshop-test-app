<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\StudentProgram;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
class StudentProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentProgram =  StudentProgram::with(['student', 'program'])->paginate(10);
        return response()->json($studentProgram);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentProgram $studentProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentProgram $studentProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentProgram $studentProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentProgram $studentProgram)
    {
        //
    }
}
