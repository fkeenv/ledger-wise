<?php

namespace App\Http\Controllers\Tenants\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Accounting\Account;
use App\Repositories\Accounting\AccountRepository;
use App\Http\Requests\Tenants\Accounting\AccountRequest;

class AccountController extends Controller
{
    public function __construct(
        private AccountRepository $accountRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->accountRepository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $request)
    {
        return $this->accountRepository->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return $this->accountRepository->show($account->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, Account $account)
    {
        return $this->accountRepository->update($request->all(), $account->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        return $this->accountRepository->destroy($account->id);
    }
}
