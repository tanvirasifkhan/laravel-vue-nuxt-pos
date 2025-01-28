<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");

        Supplier::truncate();

        Supplier::insert([
            [
                'name' => 'Supplier One',
                'email' => 'supplier.one@gmail.com',
                'phone' => '01942654501',
                'address' => 'Dhaka, Bangladesh'
            ],
            [
                'name' => 'Supplier Two',
                'email' => 'supplier.two@gmail.com',
                'phone' => '01942654601',
                'address' => 'Rajshahi, Bangladesh'
            ],
            [
                'name' => 'Supplier Three',
                'email' => 'supplier.three@gmail.com',
                'phone' => '01942654701',
                'address' => 'Sylhet, Bangladesh'
            ]
        ]);
    }
}
