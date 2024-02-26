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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150);
            $table->string('url')->nullable();
            $table->string('cover')->nullable();
            $table->string('intro', 300)->nullable();

            $table->text('content')->nullable();
            $table->text('html')->nullable();

            $table
                ->foreignIdFor(\App\Models\User::class, 'author_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table
                ->foreignIdFor(\App\Models\Topic::class)
                ->constrained();

            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
