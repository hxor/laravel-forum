<?php

use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1 = 'Discussion 1 Sample';
        $t2 = 'Discussion 2 Sample';

        $data = [
            [
                'slug' => str_slug($t1, '-'),
                'title' => $t1,
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quod architecto laborum doloremque? Aspernatur dolore ea fugit illum laudantium eveniet eaque id adipisci molestiae explicabo accusamus, dignissimos inventore, fuga iusto!',
                'user_id' => 1,
                'channel_id' => 1
            ],
            [
                'slug' => str_slug($t2, '-'),
                'title' => $t2,
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quod architecto laborum doloremque? Aspernatur dolore ea fugit illum laudantium eveniet eaque id adipisci molestiae explicabo accusamus, dignissimos inventore, fuga iusto!',
                'user_id' => 1,
                'channel_id' => 2
            ]
        ];

        \DB::table('discussions')->insert($data);
    }
}
