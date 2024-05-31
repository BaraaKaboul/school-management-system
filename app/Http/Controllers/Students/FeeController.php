<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeesRequest;
use App\Models\Fee;
use App\Repository\FeesRepositoryInterface;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    protected $fee;
    public function __construct(FeesRepositoryInterface $fee)
    {
        return $this->fee = $fee;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->fee->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->fee->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeesRequest $request)
    {
        return $this->fee->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->fee->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeesRequest $request)
    {
        return $this->fee->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->fee->destroy($request);
    }
}
