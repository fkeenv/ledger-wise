<?php

namespace Tests;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $tenancy = false;

    public function setUp(): void
    {
        parent::setUp();

        if ($this->tenancy) {
            $this->initializeTenancy();
        }
    }

    public function initializeTenancy()
    {
        if ($tenant = Tenant::find('test_tenant')) {
            $tenant->delete();
        }

        $tenant = Tenant::create([
            'name' => 'Test Tenant',
            'id' => 'test_tenant',
            'tenancy_db_name' => 'test_tenant',
        ]);
        $tenant->domains()->create(['domain' => 'test.ledger-wise.test']);

        tenancy()->initialize($tenant);
    }
}
