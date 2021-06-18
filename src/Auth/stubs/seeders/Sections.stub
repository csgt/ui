<?php
namespace Database\Seeders;

use Csgt\Cancerbero\CsgtModule;

// new CsgtModule($aName, $aDescription, $aModule, $aMenuOrder, [$aIcon=null, $aParentModule=null, $aPermissions=CsgtModule::ALL, $aMenuPermission = 'index'])

class Sections
{
    public function get()
    {
        return collect([
            new CsgtModule('Inicio', 'Inicio', 'index', 1000, 'fa fa-home', null, CsgtModule::INDEX),
            new CsgtModule('Catálogos', '', 'catalogs', 2000, 'fa fa-book', null, []),
            new CsgtModule('Usuarios', 'Catálogos - Usuarios', 'catalogs.users', 100, 'fa fa-users', 'catalogs'),
            new CsgtModule('Roles', 'Catálogos - Roles', 'catalogs.roles', 200, 'fa fa-key', 'catalogs'),
        ]);
    }
}
