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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreignid("user_id")->constrained()->orDelete("cascade")->nullable();
            $table->foreignid("address_id")->constrained()->orDelete("cascade")->nullable();
            $table->decimal('amount', 10, 2);
            $table->boolean('status')->default(false);
            $table->string('payment_method')->default('razorpay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
