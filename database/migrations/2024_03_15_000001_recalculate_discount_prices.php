<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Recalculate all discount prices based on discount_percentage
        DB::statement('UPDATE products SET discount_price = CASE 
            WHEN discount_percentage > 0 THEN price - (price * discount_percentage / 100)
            ELSE price
        END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse
    }
};
