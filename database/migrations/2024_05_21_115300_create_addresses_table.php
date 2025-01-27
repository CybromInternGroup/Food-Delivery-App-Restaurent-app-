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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('alt_contact')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpadte('cascade');
            $table->string('landmark');
            $table->string('street_name');
            $table->string('area');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->enum('type',['o','h']);  //f:office , h:home
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
