<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = [
            [
                'code' => 'WELCOME20',
                'type' => 'Percentage',
                'amount' => 20.00,
                'status' => 'Active',
            ],
            [
                'code' => 'FREESHIP',
                'type' => 'Shipping',
                'amount' => 0.00,
                'status' => 'Expired',
            ],
            [
                'code' => 'GOLDEN10',
                'type' => 'Fixed',
                'amount' => 10.00,
                'status' => 'Active',
            ],
        ];

        foreach ($discounts as $d) {
            Discount::updateOrCreate(
                ['code' => $d['code']],
                [
                    'type' => $d['type'],
                    'amount' => $d['amount'],
                    'status' => $d['status'],
                ]
            );
        }
    }
}
