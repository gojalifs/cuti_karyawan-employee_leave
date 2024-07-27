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
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('dept');
            $table->foreign('dept')->references('id')->on('dept')->restrictOnDelete()->restrictOnUpdate();
            $table->string('address');
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('role');
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
