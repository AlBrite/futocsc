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
        Schema::create('advisors', function (Blueprint $table) {
            $table->unsignedBigInteger('id');       // Advisors' id
            $table->unsignedBigInteger('set_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            
            $table->string('staff_id')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('image')->nullable();

            $table->timestamps();

            // Establish relationships
            $table->foreign('id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisors');
    }
};
