<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->decimal('delivery_fee', 8, 2)->default(0)->after('logo');
            $table->decimal('free_delivery_threshold', 8, 2)->nullable()->after('delivery_fee');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['delivery_fee', 'free_delivery_threshold']);
        });
    }
};