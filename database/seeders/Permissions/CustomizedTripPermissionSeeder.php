<?php

namespace Database\Seeders\Permissions;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CustomizedTripPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = ['customized-trips.list','customized-trips.show', 'customized-trips.create', 'customized-trips.edit', 'customized-trips.delete', 'customized-trips.restore'];
        $permissions_db = [];
        foreach ($permissions as $permission) {
            $permissions_db[] = Permission::updateOrCreate([
                'name' => $permission
            ])->id;
        }

        if ($adminRole = Role::whereName('Administrator')->first()) {
            $adminRole->givePermissionTo($permissions_db);
        }
    }
}
