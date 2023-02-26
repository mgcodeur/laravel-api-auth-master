<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mgcodeur\LaravelApiAuthMaster\Traits\Migrations\PackageMigrationTrait;

return new class extends Migration
{
    use PackageMigrationTrait;

    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('provider_name');
            $table->string('provider_id');
            $table->foreignId($this->getTableId())
                ->constrained($this->getTable())
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_accounts');
    }
};
