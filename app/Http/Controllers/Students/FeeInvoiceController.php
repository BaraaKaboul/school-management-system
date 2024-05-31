<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\FeesInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class FeeInvoiceController extends Controller
{
    protected $fee_invoice;
    public function __construct(FeesInvoicesRepositoryInterface $fee_invoice){
        return $this->fee_invoice = $fee_invoice;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->fee_invoice->index();
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
        return $this->fee_invoice->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->fee_invoice->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->fee_invoice->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->fee_invoice->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->fee_invoice->destroy($request);
    }
}
