<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcement_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_id')->constrained('announcements')->onDelete('cascade')->onUpdate('cascade');
            $table->string('photo_url', 512);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcement_photos');
    }
};
