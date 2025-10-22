<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('species', 100);
            $table->string('breed', 255)->nullable();
            $table->integer('age_min')->nullable();
            $table->integer('age_max')->nullable();
            $table->enum('sex', ['M', 'F', 'Mixed', 'Unknown'])->default('Unknown');
            $table->integer('count')->default(1);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->string('location_city', 100)->nullable();
            $table->string('main_photo', 512)->nullable();
            $table->enum('status', ['active', 'closed'])->default('active');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('views')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
