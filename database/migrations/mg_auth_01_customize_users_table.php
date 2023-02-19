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
        if (! Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        } else {
            $this->dropAndAddColumn($this->getTable(), ['name'], ['first_name', 'last_name']);
        }
    }

    public function down()
    {
        $this->dropAndAddColumn($this->getTable(), ['first_name', 'last_name'], ['name']);
    }
};
