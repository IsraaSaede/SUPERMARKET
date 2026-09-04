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
        // 1) إضافة عمود العنوان الموحد الجديد
        Schema::table('orders', function (Blueprint $table) {
            $table->string('address')->nullable()->after('phone');
        });

        // 2) نقل بيانات الطلبات القديمة (لو موجودة) للعمود الجديد
        //    بدل ما تنضاع، بندمج area + street + building + floor بسطر واحد
        DB::table('orders')->orderBy('id')->chunkById(100, function ($orders) {
            foreach ($orders as $order) {
                $parts = array_filter([
                    $order->area ?? null,
                    $order->street ?? null,
                    ! empty($order->building) ? "بناء {$order->building}" : null,
                    ! empty($order->floor) ? "طابق {$order->floor}" : null,
                ]);

                DB::table('orders')
                    ->where('id', $order->id)
                    ->update([
                        'address' => $parts ? implode('، ', $parts) : null,
                    ]);
            }
        });

        // 3) حذف الأعمدة القديمة نهائياً بعد ما ضمنّا نقل البيانات
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['area', 'street', 'building', 'floor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('area')->nullable()->after('phone');
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
        });

        DB::table('orders')->orderBy('id')->chunkById(100, function ($orders) {
            foreach ($orders as $order) {
                DB::table('orders')
                    ->where('id', $order->id)
                    ->update(['area' => $order->address]);
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('address');
        });
    }
};
