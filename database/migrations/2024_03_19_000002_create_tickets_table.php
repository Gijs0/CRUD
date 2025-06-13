<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('festival_id')->constrained()->onDelete('cascade');
            $table->string('type'); // Regular, VIP, Early Bird, etc.
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('quantity_available');
            $table->integer('quantity_sold')->default(0);
            $table->dateTime('sale_start_date');
            $table->dateTime('sale_end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}; 