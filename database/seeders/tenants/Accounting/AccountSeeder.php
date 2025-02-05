<?php

namespace Database\Seeders\tenants\Accounting;

use Illuminate\Database\Seeder;
use App\Models\Tenants\Accounting\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assets
        Account::create([
            'name' => 'Assets',
            'code' => '1000',
            'description' => 'Assets',
            'children' => [
                [
                    'name' => 'Current Assets',
                    'code' => '1100',
                    'description' => 'Current Assets',
                    'children' => [
                        [
                            'name' => 'Cash',
                            'code' => '1110',
                            'description' => 'Cash',
                        ],
                        [
                            'name' => 'Bank',
                            'code' => '1120',
                            'description' => 'Bank',
                        ],
                        [
                            'name' => 'Accounts Receivable',
                            'code' => '1130',
                            'description' => 'Accounts Receivable',
                        ],
                        [
                            'name' => 'Inventory',
                            'code' => '1140',
                            'description' => 'Inventory',
                        ],
                    ],
                ],
                [
                    'name' => 'Non-Current Assets',
                    'code' => '1200',
                    'description' => 'Non-Current Assets',
                    'children' => [
                        [
                            'name' => 'Property, Plant, and Equipment',
                            'code' => '1210',
                            'description' => 'Property, Plant, and Equipment',
                        ],
                        [
                            'name' => 'Intangible Assets',
                            'code' => '1220',
                            'description' => 'Intangible Assets',
                        ],
                        [
                            'name' => 'Investment',
                            'code' => '1230',
                            'description' => 'Investment',
                        ],
                    ],
                ],
            ],
        ]);

        // Liabilities
        Account::create([
            'name' => 'Liabilities',
            'code' => '2000',
            'description' => 'Liabilities',
            'children' => [
                [
                    'name' => 'Current Liabilities',
                    'code' => '2100',
                    'description' => 'Current Liabilities',
                    'children' => [
                        [
                            'name' => 'Accounts Payable',
                            'code' => '2110',
                            'description' => 'Accounts Payable',
                        ],
                        [
                            'name' => 'Accrued Expenses',
                            'code' => '2120',
                            'description' => 'Accrued Expenses',
                        ],
                        [
                            'name' => 'Short-term Debt',
                            'code' => '2130',
                            'description' => 'Short-term Debt',
                        ],
                    ],
                ],
                [
                    'name' => 'Non-Current Liabilities',
                    'code' => '2200',
                    'description' => 'Non-Current Liabilities',
                    'children' => [
                        [
                            'name' => 'Long-term Debt',
                            'code' => '2210',
                            'description' => 'Long-term Debt',
                        ],
                        [
                            'name' => 'Deferred Tax',
                            'code' => '2220',
                            'description' => 'Deferred Tax',
                        ],
                    ],
                ],
            ],
        ]);

        // Equity
        Account::create([
            'name' => 'Equity',
            'code' => '3000',
            'description' => 'Equity',
            'children' => [
                [
                    'name' => 'Retained Earnings',
                    'code' => '3100',
                    'description' => 'Retained Earnings',
                ],
                [
                    'name' => 'Common Stock',
                    'code' => '3200',
                    'description' => 'Common Stock',
                ],
            ],
        ]);

        // Revenue
        Account::create([
            'name' => 'Revenue',
            'code' => '4000',
            'description' => 'Revenue',
            'children' => [
                [
                    'name' => 'Sales',
                    'code' => '4100',
                    'description' => 'Sales',
                ],
                [
                    'name' => 'Interest Income',
                    'code' => '4200',
                    'description' => 'Interest Income',
                ],
            ],
        ]);

        // Expenses
        Account::create([
            'name' => 'Expenses',
            'code' => '5000',
            'description' => 'Expenses',
            'children' => [
                [
                    'name' => 'Cost of Goods Sold',
                    'code' => '5100',
                    'description' => 'Cost of Goods Sold',
                ],
                [
                    'name' => 'Salaries and Wages',
                    'code' => '5200',
                    'description' => 'Salaries and Wages',
                ],
                [
                    'name' => 'Rent Expense',
                    'code' => '5300',
                    'description' => 'Rent Expense',
                ],
                [
                    'name' => 'Utilities Expense',
                    'code' => '5400',
                    'description' => 'Utilities Expense',
                ],
                [
                    'name' => 'Depreciation Expense',
                    'code' => '5500',
                    'description' => 'Depreciation Expense',
                ],
                [
                    'name' => 'Interest Expense',
                    'code' => '5600',
                    'description' => 'Interest Expense',
                ],
                [
                    'name' => 'Meals Expense',
                    'code' => '5700',
                    'description' => 'Meals Expense',
                ],
            ],
        ]);
    }
}
