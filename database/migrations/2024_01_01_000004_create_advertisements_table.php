<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('purchase_id')->constrained()->onDelete('cascade'); // which package purchase
            $table->string('medicine_name');
            $table->string('medicine_type');
            $table->string('company_logo')->nullable();
            $table->string('location');
            $table->text('description');
            $table->boolean('is_approved')->default(false);
            $table->timestamp('expires_at')->nullable(); // when ad should be removed
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('advertisements');
    }
};