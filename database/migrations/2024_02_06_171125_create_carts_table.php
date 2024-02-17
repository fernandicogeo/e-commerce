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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('item_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('total_price')->nullable();
            $table->string('isDeleted')->nullable(); // 0 for not deleted, 1 for deleted
            $table->string('isActived')->nullable(); // 0 for active, 1 for cancel, 2 for checkouted, 3 for paid
            $table->string('payment_id')->nullable();
            $table->string('payment_total_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
