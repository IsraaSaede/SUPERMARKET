<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('local_daily_records', function (Blueprint $table) {
            $table->id();

            $table->date('date')->unique();

            $table->decimal('sales_total', 12, 2)->default(0);

            $table->decimal('purchases_total', 12, 2)->default(0);

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('local_daily_records');
    }
};
