<?php

namespace App\Http\Controllers\Tenants\Accounting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenants\Accounting\ChartOfAccount;
use App\Repositories\Accounting\ChartOfAccountRepository;

class ChartOfAccountController extends Controller
{
    public function __construct(
        private ChartOfAccountRepository $chartOfAccountRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->chartOfAccountRepository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->chartOfAccountRepository->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(ChartOfAccount $chartOfAccount)
    {
        return $this->chartOfAccountRepository->show($chartOfAccount->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChartOfAccount $chartOfAccount)
    {
        return $this->chartOfAccountRepository->update($request->all(), $chartOfAccount->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChartOfAccount $chartOfAccount)
    {
        return $this->chartOfAccountRepository->destroy($chartOfAccount->id);
    }
}
