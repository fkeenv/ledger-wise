<?php

namespace App\Http\Controllers\Tenants\HRIS;

use App\Http\Controllers\Controller;
use App\Models\Tenants\HRIS\Position;
use App\Repositories\HRIS\PositionRepository;
use App\Http\Requests\Tenants\HRIS\PositionRequest;

class PositionController extends Controller
{
    public function __construct(
        private PositionRepository $positionRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->positionRepository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionRequest $request)
    {
        $data = $request->validated();

        return $this->positionRepository->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return $this->positionRepository->show($position);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionRequest $request, Position $position)
    {
        $data = $request->validated();

        return $this->positionRepository->update($position, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        return tap($position)->delete();
    }
}
