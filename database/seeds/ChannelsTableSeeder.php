<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => 'Channel-1'],
            ['title' => 'Channel-2']
        ];

        \DB::table('channels')->insert($data);
    }
}
