<?php

namespace Tests;

use App\Models\Tenant;
use Illuminate\Support\Facades\URL;
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

        URL::forceRootUrl('https://test.ledger-wise.test');
    }

    public function tearDown(): void
    {
        config([
            'tenancy.queue_database_deletion' => false,
            'tenancy.delete_database_after_tenant_deletion' => true,
        ]);

        Tenant::all()->where('id', '!=', 'norwood')->each->delete();

        parent::tearDown();
    }
}
