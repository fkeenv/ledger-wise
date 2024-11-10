<?php

namespace App\Repositories\Accounting;

use App\Models\Tenants\Accounting\ChartOfAccount;

class ChartOfAccountRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ChartOfAccount $chartOfAccount
    ) {
        //
    }

    /**
     * Get all chart of accounts.
     */
    public function get()
    {
        return $this->chartOfAccount->get();
    }

    public function store(array $data)
    {
        return $this->chartOfAccount->create($data);
    }

    public function show(int $id)
    {
        return $this->chartOfAccount->findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $chartOfAccount = $this->chartOfAccount->findOrFail($id);
        $chartOfAccount->update($data);

        return $chartOfAccount;
    }

    public function destroy(int $id)
    {
        $chartOfAccount = $this->chartOfAccount->findOrFail($id);
        $chartOfAccount->delete();

        return $chartOfAccount;
    }
}
