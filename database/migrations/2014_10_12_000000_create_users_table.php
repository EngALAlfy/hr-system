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
            $table->string('name' , 100);
            $table->string('email' , 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('api_token')->nullable();
            $table->string('job_title' , 50)->nullable();
            $table->string('password');
            $table->double('salary')->default(0);
            $table->double('wallet')->default(0);
            $table->rememberToken();
            $table->timestamps();
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
