<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use \App\Models\EventCategory;
use \App\Models\User;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('event_name');
            $table->longText('event_description');
            $table->double('event_highlighted')->default(false);
            $table->foreignIdFor(EventCategory::class,'event_category_uuid')->constraint()->onDelete('cascade')->nullable();
            $table->foreignIdFor(User::class,'user_id')->constraint()->onDelete('cascade')->nullable();
            $table->string('event_cover_photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
