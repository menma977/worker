<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(): void
  {
    Schema::create('users', static function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->integer('role');
      $table->string('username')->unique();
      $table->string('password');
      $table->string('code')->unique();
      $table->integer('benefit');
      $table->text('phone')->nullable();
      $table->text('address')->nullable();
      $table->integer('suspend');
      $table->integer('delete');
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
}
