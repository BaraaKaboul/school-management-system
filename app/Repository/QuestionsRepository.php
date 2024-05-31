<?php

namespace App\Repository;

use App\Models\Question;
use App\Models\Quizz;

class QuestionsRepository implements QuestionsRepositoryInterface
{
    public function index()
    {
        $questions = Question::all();
        return view('pages.questions.index',compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizz::all();
        return view('pages.questions.create',compact('quizzes'));
    }

    public function store($request)
    {
        try {
            $question = new Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizze_id;
            $question->save();

            toastr()->success(trans('messages.success'));
            return to_route('question.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $quizzes = Quizz::all();
        return view('pages.questions.edit',compact('question','quizzes'));
    }

    public function update($request)
    {
        try {
            $question = Question::findOrFail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizze_id = $request->quizze_id;
            $question->save();

            toastr()->info(trans('messages.info'));
            return to_route('question.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function  destroy($request)
    {
        Question::destroy($request->id);

        toastr()->error(trans('messages.delete'));
        return to_route('question.index');
    }
}
