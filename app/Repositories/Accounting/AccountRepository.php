<?php

namespace App\Repositories\Accounting;

use App\Models\Tenants\Accounting\Account;

class AccountRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected Account $account
    ) {
    }

    /**
     * Get all chart of accounts.
     */
    public function get()
    {
        return $this->account->get();
    }

    public function store(array $data)
    {
        return $this->account->create($data);
    }

    public function show(int $id)
    {
        return $this->account->findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $account = $this->account->findOrFail($id);
        $account->update($data);

        return $account;
    }

    public function destroy(int $id)
    {
        $account = $this->account->find($id);

        $account = tap($account)->delete();

        return $account;
    }
}
