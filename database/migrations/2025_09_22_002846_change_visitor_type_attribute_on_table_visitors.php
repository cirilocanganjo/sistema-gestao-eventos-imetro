<?php

use App\Models\VisitorType;
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
          Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn('visitor_type');    
            $table->foreignIdFor(VisitorType::class)->after('uuid');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
