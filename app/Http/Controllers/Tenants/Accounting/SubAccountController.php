<?php

namespace App\Http\Controllers\Tenants\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Accounting\Account;
use App\Http\Requests\Tenants\Accounting\AccountRequest;

class SubAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Account $account)
    {
        return $account->children;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $request, Account $account)
    {
        $account->children()->create([
            'parent_id' => $account->id,
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'is_hidden' => $request->is_hidden,
        ]);

        return $account->children;
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account, Account $subAccount)
    {
        return $subAccount;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, Account $account, Account $subAccount)
    {
        $subAccount->update([
            'parent_id' => $account->id,
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'is_hidden' => $request->is_hidden,
        ]);

        return $subAccount;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account, Account $subAccount)
    {
        $subAccount->delete();

        return $account->children;
    }
}
