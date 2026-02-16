<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->decimal('price', 10,2);
            $table->integer('ad_limit'); // number of ads allowed
            $table->integer('validity_minutes'); // validity in minutes
            // Advanced pricing (optional)
            $table->decimal('silver_price', 10,2)->nullable();
            $table->decimal('gold_price', 10,2)->nullable();
            $table->decimal('diamond_price', 10,2)->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('packages');
    }
};