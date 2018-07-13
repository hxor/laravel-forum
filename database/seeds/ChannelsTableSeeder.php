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
            ['title' => 'Channel-1', 'slug' => 'channel-1', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
            ['title' => 'Channel-2', 'slug' => 'channel-2', 'created_at' => new DateTime(), 'updated_at' => new DateTime()]
        ];

        \DB::table('channels')->insert($data);
    }
}
