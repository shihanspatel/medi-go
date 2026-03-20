<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'discount_price')) {
                $table->decimal('discount_price', 10, 2)->nullable()->after('price')->comment('Price after discount');
            }
            if (!Schema::hasColumn('products', 'discount_percentage')) {
                $table->integer('discount_percentage')->default(0)->after('discount')->comment('Discount percentage');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'discount_price')) {
                $table->dropColumn('discount_price');
            }
            if (Schema::hasColumn('products', 'discount_percentage')) {
                $table->dropColumn('discount_percentage');
            }
        });
    }
};
