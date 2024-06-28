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
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->foreignid("order_id")->constrained()->orDelete("cascade");
            $table->foreignid("product_id")->constrained()->orDelete("cascade");
            $table->foreignid("address_id")->constrained()->orDelete("cascade")->nullable();
            $table->integer("quantity")->default(1);
            $table->integer("price");
            $table->boolean("status")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderitems');
    }
};
