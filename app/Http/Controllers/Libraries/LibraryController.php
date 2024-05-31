<?php

namespace App\Http\Controllers\Libraries;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Repository\LibraryRepositoryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    protected $library;
    public function __construct(LibraryRepositoryInterface $library)
    {
        return $this->library = $library;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->library->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->library->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->library->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->library->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->library->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->library->destroy($request);
    }

    public function download($fln)
    {
        return $this->library->download($fln);
    }
}
