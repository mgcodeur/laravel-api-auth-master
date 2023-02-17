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

    public function dropAndAddColumn(string $destinationTable, array $columnsToDrop, array $columnsToAdd): void
    {
        Schema::table($destinationTable, function (Blueprint $table) use ($columnsToDrop, $columnsToAdd, $destinationTable) {
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn($destinationTable, $column)) {
                    $table->dropColumn($column);
                }
            }

            foreach ($columnsToAdd as $column) {
                match ($column) {
                    'first_name' => $table->string('first_name')->nullable()->after('id'),
                    'last_name' => $table->string('last_name')->nullable()->after('first_name'),
                };
            }
        });
    }
}
