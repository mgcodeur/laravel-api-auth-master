<?php

use Illuminate\Database\Migrations\Migration;
use Mgcodeur\LaravelApiAuthMaster\Traits\Migrations\UserMigrationTrait;

return new class extends Migration
{
    use UserMigrationTrait;

    public function up()
    {
        $this->dropAndAddColumn($this->getTable(), ['name'], ['first_name', 'last_name']);
    }

    public function down()
    {
        $this->dropAndAddColumn($this->getTable(), ['first_name', 'last_name'], ['name']);
    }
};
