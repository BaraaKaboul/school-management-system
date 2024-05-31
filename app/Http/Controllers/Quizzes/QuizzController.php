<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Quizz;
use App\Models\Section;
use App\Repository\QuizzRepositoryInterface;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    protected $quizz;
    public function __construct(QuizzRepositoryInterface $quizz)
    {
        return $this->quizz = $quizz;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->quizz->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->quizz->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->quizz->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quizz $quizz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->quizz->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->quizz->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->quizz->destroy($request);
    }



}
