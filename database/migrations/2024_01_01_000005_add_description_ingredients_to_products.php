<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'description')) {
                $table->longText('description')->nullable()->after('price');
            }
            if (!Schema::hasColumn('products', 'ingredients')) {
                $table->longText('ingredients')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('products', 'ingredients')) {
                $table->dropColumn('ingredients');
            }
        });
    }
};
