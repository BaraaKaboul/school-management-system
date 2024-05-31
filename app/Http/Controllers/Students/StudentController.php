<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Classroom;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $student;

    public function __construct(StudentRepositoryInterface $student ){
        return $this->student = $student;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->student->getStudents();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->student->viewAddStudent();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        return $this->student->storeStudent($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->student->showStudent($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->student->editStudent($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        return $this->student->updateStudent($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->student->deleteStudent($request);
    }

    public function getClassroom($id){

        return $this->student->get_classroom($id);
    }

    public function getSection($id){

        return $this->student->get_section($id);
    }

    public function Upload_attachment(Request $request){

        return $this->student->uploadAttachment($request);
    }

    public function Download_attachment($studentsname, $filename){

        return $this->student->downloadAttachment($studentsname, $filename);
    }

    public function Delete_attachment(Request $request){

        return $this->student->deleteAttachment($request);
    }
}
