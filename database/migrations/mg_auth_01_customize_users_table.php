<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Mgcodeur\LaravelApiAuthMaster\Traits\Migrations\UserMigrationTrait;

return new class extends Migration
{
    use UserMigrationTrait;

    public function up()
    {
        if (! Schema::hasTable($this->getTable())) $this->createUsersTable(); else {
            $this->dropColumnAndAdd($this->getTable(), ['name'], ['first_name', 'last_name']);
        }
    }

    public function down()
    {
        $this->dropColumnAndAdd($this->getTable(), ['first_name', 'last_name'], ['name']);
    }
};
