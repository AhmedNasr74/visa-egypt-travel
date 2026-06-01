<?php

namespace Database\Seeders\Permissions;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ContactPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = ['contacts.list', 'contacts.create', 'contacts.edit', 'contacts.delete', 'contacts.restore'];
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
