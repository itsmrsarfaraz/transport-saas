<?php

// database/seeders/RolePermissionSeeder.php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'routes.manage', 'vehicles.manage', 'drivers.manage',
            'bookings.manage', 'bookings.cancel', 'leads.view',
            'fares.manage', 'reports.view',
        ];

        foreach ($permissions as $slug) {
            Permission::firstOrCreate(['slug' => $slug], ['name' => ucwords(str_replace(['.', '-'], ' ', $slug))]);
        }

        $roles = [
            'super-admin' => $permissions,
            'admin' => ['routes.manage', 'vehicles.manage', 'drivers.manage', 'bookings.manage', 'leads.view', 'fares.manage', 'reports.view'],
            'dispatcher' => ['routes.manage', 'vehicles.manage', 'drivers.manage', 'bookings.manage'],
            'driver' => [],
            'customer' => [],
        ];

        foreach ($roles as $slug => $perms) {
            $role = Role::firstOrCreate(['slug' => $slug], ['name' => ucwords(str_replace('-', ' ', $slug))]);
            $role->permissions()->sync(
                Permission::whereIn('slug', $perms)->pluck('id')
            );
        }
    }
}