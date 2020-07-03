<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        $this->call('ModulesSeeder');
        $this->call('PermissionsSeeder');
        $this->call('ModulePermissionsSeeder');
        $this->call('MenuSeeder');
        Schema::enableForeignKeyConstraints();
        Model::reguard();

        Cache::flush();
    }
}
