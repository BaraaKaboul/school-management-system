<?php

namespace App\Repository;

use App\Http\Traits\AttachmentFilesTrait;
use App\Models\Grade;
use App\Models\Library;

class LibraryRepository implements LibraryRepositoryInterface
{
    use AttachmentFilesTrait;
    public function index()
    {
        $books = Library::all();
        return view('pages.libraries.index',compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.libraries.create')->with(['grades'=>$grades]);// هاي بعمل عمل ال compact
    }

    public function store($request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $books->save();

            $this->uploadFile($request,'file_name');

            toastr()->success(trans('messages.success'),'حفظ');
            return redirect()->route('library.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $book = Library::findOrFail($id);
        $grades = Grade::all();
        return view('pages.libraries.edit',compact('book','grades'));
    }

    public function update($request)
    {
        try {

            $book = library::findorFail($request->id);
            $book->title = $request->title;

            if($request->hasfile('file_name')){

                $this->deleteFile($book->file_name, 'library');

                $this->uploadFile($request,'file_name','library');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();

            toastr()->info(trans('messages.Update'));
            return redirect()->route('library.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $this->deleteFile($request->file_name);
        Library::destroy($request->id);

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        return response()->download(public_path('attachments/library/'.$filename));
    }
}