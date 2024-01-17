<?php
namespace Database\Seeders;

use Database\Seeders\Sections;
use Illuminate\Database\Seeder;
use App\Models\Auth\ModulePermission;

class ModulePermissionsSeeder extends Seeder
{
    public function run()
    {
        $sections = new Sections;
        $sections = $sections->get()->filter(function ($section) {
            return $section->permissions !== [];
        });

        ModulePermission::truncate();

        $insertPermissions = $sections->map(function ($section, $arr) {
            return collect($section->permissions)->map(function ($permission) use ($section, $arr) {

                if (is_numeric($permission)) {
                    $permission = $arr[$permission];
                }

                return $section->module . '.' . $permission;
            });
        })->flatten()->map(function ($item) {
            return ['name' => $item];
        })->toArray();

        ModulePermission::insert($insertPermissions);
    }
}
