<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;  //هون بستدعي بس الInterface يعني المكان لعرفت فيو الفانكشنز

class TeacherController extends Controller
{

    protected $teacher;//ها الحكي كلو مشان يحس بشغل الdesign pattern
    public function __construct(TeacherRepositoryInterface $teacher)
    {
        //يعني انا لما استدعيت teacher يعني بقلو استدعيلي TeacherRepositoryInterface
        $this->teacher = $teacher;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers =  $this->teacher->getTeachers();
        return view('pages.teachers.teachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->teacher->getSpecialization();
        $genders = $this->teacher->getGender();
        return view('pages.teachers.create', compact('specializations','genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        return $this->teacher->storeTeacher($request);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $Teachers = $this->teacher->editTeacher($id);
        $specializations = $this->teacher->getSpecialization();
        $genders = $this->teacher->getGender();
        return view('pages.teachers.edit',compact('Teachers','specializations','genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->teacher->updateTeacher($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->teacher->deleteTeacher($request);
    }
}
