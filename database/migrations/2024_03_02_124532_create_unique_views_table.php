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
        Schema::create('unique_views', function (Blueprint $table) {
            $table->id();

            $table->morphs('viewable');
            $table->foreignIdFor(\App\Models\User::class);

            $table->unique(['viewable_type', 'viewable_id', 'user_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unique_views');
    }
};
