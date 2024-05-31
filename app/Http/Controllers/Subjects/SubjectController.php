<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Repository\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subject;
    public function __construct(SubjectRepositoryInterface $subject)
    {
        return $this->subject = $subject;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->subject->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->subject->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->subject->store($request);
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
        return $this->subject->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->subject->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->subject->destroy($request);
    }
}
