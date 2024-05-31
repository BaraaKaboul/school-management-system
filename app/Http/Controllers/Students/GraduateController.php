<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\StudentGraduateRepositoryInterface;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    protected $graduate;
    public function __construct(StudentGraduateRepositoryInterface $graduate){
        $this->graduate = $graduate;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->graduate->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->graduate->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->graduate->softDelete($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->graduate->returnStudent($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->graduate->forceDelete($request);
    }

    public function graduateStudent(Request $request){
        return $this->graduate->graduateStudent($request);
    }
}
