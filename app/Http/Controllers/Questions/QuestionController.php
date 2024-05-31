<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Repository\QuestionsRepositoryInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $question;
    public function __construct(QuestionsRepositoryInterface $question)
    {
        return $this->question = $question;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->question->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->question->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->question->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->question->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->question->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->question->destroy($request);
    }
}
