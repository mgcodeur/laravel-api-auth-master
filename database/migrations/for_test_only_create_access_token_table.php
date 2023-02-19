<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mgcodeur\LaravelApiAuthMaster\Traits\Migrations\UserMigrationTrait;

return new class extends Migration
{
    use UserMigrationTrait;

    public function up()
    {
        //Laravel Sanctum Simulation (test only)
        if(!Schema::hasTable('personal_access_tokens')) {
            Schema::create('personal_access_tokens', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tokenable_id')->index();
                $table->string('tokenable_type');
                $table->string('name');
                $table->string('token', 64)->unique();
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
