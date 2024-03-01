<?php
namespace Database\Seeders;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Auth\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InitialSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Role::insert([
            'id'          => 1,
            'name'        => 'Backdoor',
            'description' => 'Rol Backdoor',
            'created_at'  => date_create(),
            'updated_at'  => date_create(),
        ]);

        User::insert([
            'id'         => 1,
            'email'      => 'cs@cs.com.gt',
            'password'   => '$2y$10$zOrPimtXtgVXl/nphcryoeo/mxS0oB6uBQZpmZFIB8M8ad1wc9vMi',
            'name'       => config('app.name'),
            'active'     => 1,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        UserRole::insert([
            'user_id'    => 1,
            'role_id'    => 1,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        DB::statement('INSERT INTO role_module_permissions (role_id, module_permission, created_at, updated_at)
				SELECT 1, name, NOW(), NOW() FROM module_permissions');

        Schema::enableForeignKeyConstraints();
    }
}
