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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Post::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\User::class, 'author_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\Comment::class, 'parent_id')
                ->nullable()
                ->references('id')
                ->on('comments');

            $table->text('content');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
