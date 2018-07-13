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
            ['title' => 'Channel-1', 'slug' => 'channel-1'],
            ['title' => 'Channel-2', 'slug' => 'channel-2']
        ];

        \DB::table('channels')->insert($data);
    }
}
