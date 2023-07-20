<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['pending','in-progress','rejected','approved'];
        foreach($status as $item)
        {
            Status::create([
                'status' => $item
            ]);
        }
    }
}
