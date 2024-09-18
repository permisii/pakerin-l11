<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $units = [
            [
                'name' => 'General Support',
            ],
            [
                'name' => 'Unit Produksi 1/2',
            ], [
                'name' => 'Unit Produksi 3',
            ], [
                'name' => 'Unit Cogen/Soda',
            ],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
