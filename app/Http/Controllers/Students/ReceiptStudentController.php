<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\ReceiptStudentRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{
    protected $receipt;
    public function __construct(ReceiptStudentRepositoryInterface $receipt)
    {
        return $this->receipt = $receipt;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->receipt->index();
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
        return $this->receipt->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->receipt->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->receipt->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->receipt->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->receipt->destroy($request);
    }
}
