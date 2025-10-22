<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_id')->constrained('announcements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('text');
            $table->dateTime('sent_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('read_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
