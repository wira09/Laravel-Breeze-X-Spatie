<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 01.Create permissions for user
        Permission::create(['name' => 'tambah-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'hapus-user']);
        Permission::create(['name' => 'lihat-user']);
        // 02.Permissions for tulisan
        Permission::create(['name' => 'tambah-tulisan']);
        Permission::create(['name' => 'edit-tulisan']);
        Permission::create(['name' => 'hapus-tulisan']);
        Permission::create(['name' => 'lihat-tulisan']);

        // 03.Create roles and assign permissions
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'penulis']);

        $roleAdmin = Role::findByName('admin');
        $rolePenulis = Role::findByName('penulis');

        $roleAdmin->givePermissionTo([
            'tambah-user',
            'edit-user',
            'hapus-user',
            'lihat-user',
            'tambah-tulisan',
            'edit-tulisan',
            'hapus-tulisan',
            'lihat-tulisan',
        ]);

        $rolePenulis->givePermissionTo([
            'tambah-tulisan',
            'edit-tulisan',
            'hapus-tulisan',
            'lihat-tulisan',
        ]);
    }
}
