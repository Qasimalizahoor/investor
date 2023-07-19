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
        $allPermissions = ['view investor','add investor','delete investor'];
        foreach($allPermissions as $item)
        {
            Permission::create([
                'name'=> $item
            ]);
        }
        
    }
}
