<?php
use App\Models\Auth\Module;
use Illuminate\Database\Seeder;
use App\Models\Auth\ModulePermission;

class ModulePermissionsSeeder extends Seeder
{
    private $inserts = [];
    public function run()
    {
        $modules  = Module::all();
        $sections = new Sections;
        $sections = $sections->get()->filter(function ($section) {
            return $section->permissions !== [];
        });

        ModulePermission::truncate();

        $modulesPermissions = $modules->map(function ($module) use ($sections) {
            $moduleSection = $sections->first(function ($section, $key) use ($module) {
                return $section->module == $module->name;
            });

            $insertPermissions = collect($moduleSection->permissions)->map(function ($permission) {
                return ['permission_id' => $permission];
            })->toArray();

            $module->modulepermissions()->createMany($insertPermissions);

            return $moduleSection->permissions;
        });
    }
}
