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
        Schema::create('telegraph_bot_user_model', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('user_model_id');
            $table->unsignedBiginteger('telegraph_bot_id');
            $table->timestamps();

            $table->foreign('user_model_id')->references('id')
                 ->on('user_models')->onDelete('cascade');
            $table->foreign('telegraph_bot_id')->references('id')
                ->on('telegraph_bots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegraph_bot_user_model');
    }
};