<?php

use App\Models\Teacher;
use App\Models\Visitor;
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
        Schema::create('personal_data', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('full_name');
            $table->string('phone',15);
            $table->string('identity_card',45);
            $table->enum('gender', ['male', 'female']);
             $table->foreignIdFor(Teacher::class,'teacher_uuid')->constraint()->onDelete('cascade')->nullable();
             $table->foreignIdFor(Visitor::class,'visitor_uuid')->constraint()->onDelete('cascade')->nullable();
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_data');
    }
};
