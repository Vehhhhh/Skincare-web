<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Table::insert(
            [
                [
                    'name' => 'Table 1',
                    'status' => 1,

                ],
                [
                    'name' => 'Table 2',
                    'status' => 1,

                ],
                [
                    'name' => 'Table 3',
                    'status' => 1,

                ],

            ]
        );
    }
}
