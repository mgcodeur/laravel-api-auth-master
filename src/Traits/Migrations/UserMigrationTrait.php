<?php

namespace Mgcodeur\LaravelApiAuthMaster\Traits\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait UserMigrationTrait
{
    private string $table;

    public function __construct()
    {
        $this->setTable(config('api-auth-master.auth.table'));
    }

    public function setTable(string $table): self
    {
        $this->table = $table;

        return $this;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function dropColumnAndAdd(string $destinationTable, array $columnsToDrop, array $columnsToAdd): void
    {
        Schema::table($destinationTable, function (Blueprint $table) use ($columnsToDrop, $columnsToAdd, $destinationTable) {
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn($destinationTable, $column)) {
                    $table->dropColumn($column);
                }
            }

            foreach ($columnsToAdd as $column) {
                match ($column) {
                    'first_name' => $table->string($column)->nullable()->after('id'),
                    'last_name' => $table->string($column)->nullable()->after('first_name'),
                    default => '',
                };
            }
        });
    }

    public function setNullablePasswordColumn(string $destinationTable): void
    {
        Schema::table($destinationTable, function (Blueprint $table) {
            $table->string('password')->nullable()->change();
        });
    }

    public function setNotNullablePasswordColumn(string $destinationTable): void
    {
        Schema::table($destinationTable, function (Blueprint $table) {
            $table->string('password')->nullable(false)->change();
        });
    }

    public function createUsersTable(): void
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
}
