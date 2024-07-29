<?php

namespace Database\Seeders;

use App\Models\Respondent;
use Illuminate\Database\Seeder;

class RespondentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Respondent::factory()->count(600)->create();
    }
}
