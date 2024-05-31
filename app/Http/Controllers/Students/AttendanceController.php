<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Repository\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendance;
    public function __construct(AttendanceRepositoryInterface $attendance)
    {
        return $this->attendance = $attendance;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->attendance->index();
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
        return $this->attendance->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->attendance->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->attendance->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->attendance->destroy($request);
    }
}
