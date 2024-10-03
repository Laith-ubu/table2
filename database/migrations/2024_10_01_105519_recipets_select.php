<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('recipets_select', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); 
            $table->foreignId('recipet_id')->constrained('recipets')->onDelete('cascade'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipets_select');
    }
};
