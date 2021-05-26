<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class protainsettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('employees')->insert([
            [
                'dept_id' => '1',
                'name' => '川端 莉緒',
                'email' => 'kawabata_rio@example.com',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
             ]
        ]);
    }
}
