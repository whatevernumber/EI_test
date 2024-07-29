<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('cities')->insert([
            ['city_name' => 'Москва' ],
            ['city_name' => 'Санкт-Петербург'],
            ['city_name' => 'Владивосток' ],
            ['city_name' => 'Краснодар' ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('cities')->truncate();
    }
};
