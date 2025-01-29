<?php

namespace Database\Seeders;

use App\Models\SupplierLedger;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierLedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");

        SupplierLedger::truncate();

        SupplierLedger::factory()->count(5)->create();
    }
}
