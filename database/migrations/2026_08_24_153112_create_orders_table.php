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
    Schema::create('orders', function (Blueprint $table) {

        $table->id();

        $table->string('customer_name');
        $table->string('phone');

        $table->string('area');
        $table->string('street');

        $table->string('building')->nullable();
        $table->string('floor')->nullable();

        $table->text('notes')->nullable();

        $table->decimal('subtotal',10,2);
        $table->decimal('delivery_fee',10,2);
        $table->decimal('total',10,2);

        $table->enum('status',[
            'new',
            'processing',
            'completed',
            'cancelled'
        ])->default('new');

        $table->timestamps();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
