<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permission
        $permissions = [
            'posts.list', 'posts.show', 'posts.create', 'posts.update', 'posts.delete',
            'users.list', 'users.show', 'users.create', 'users.update', 'users.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // role
        $admin = Role::findOrCreate('admin');
        $editor = Role::findOrCreate('editor');

        $admin->givePermissionTo(Permission::all());
        $editor->givePermissionTo(['posts.list', 'posts.show', 'posts.create', 'posts.update']);
    }
}
