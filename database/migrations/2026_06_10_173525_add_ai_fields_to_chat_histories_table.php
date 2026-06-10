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
        Schema::table('chat_histories', function (Blueprint $table) {
            $table->string('provider')->after('answer');
            $table->string('model')->after('provider');
            $table->decimal('time_taken', 8, 2)->after('model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_histories', function (Blueprint $table) {
            $table->dropColumn([
                'provider',
                'model',
                'time_taken'
            ]);
        });
    }
};
