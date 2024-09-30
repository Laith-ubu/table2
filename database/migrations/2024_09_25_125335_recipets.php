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
        Schema::create("recipets", function (Blueprint $table) {
            $table->id();
            $table->string("name_recipets");
            $table->string("description_recipets");
            $table->integer("quantity_recipets");
            $table->decimal("total_recipets", 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists("");
    }
};
