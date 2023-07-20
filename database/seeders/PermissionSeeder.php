<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allPermissions = ['view-investor','add-investor','delete-investor','view-permission','add-permission','delete-permission',
        'add-role','view-role'];
        foreach($allPermissions as $item)
        {
            Permission::create([
                'name'=> $item
            ]);
        }
        
    }
}
