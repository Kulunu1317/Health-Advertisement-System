<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo')->nullable();
            $table->date('birthday')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_admin')->default(false);
        });
    }
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['profile_photo', 'birthday', 'telephone', 'is_approved', 'is_admin']);
        });
    }
};