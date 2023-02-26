<?php

namespace Mgcodeur\LaravelApiAuthMaster\Traits\Migrations;

trait PackageMigrationTrait
{
    protected $table;

    public function __construct()
    {
        $this->table = config('api-auth-master.auth.table');
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getTableId()
    {
        return \Illuminate\Support\Str::singular($this->table).'_id';
    }
}
