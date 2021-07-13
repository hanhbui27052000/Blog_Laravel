<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = [
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
                'created_at' => '2021-07-14 10:00:10',
                'updated_at'=> '2021-07-14 10:00:10'
            ],
            [
                'id' => 2,
                'name' => 'Hạnh Bùi',
                'email' => 'hanhbui27052000@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'author',
                'created_at' => '2021-07-14 11:00:20',
                'updated_at'=> '2021-07-14 11:00:20'
            ],
            [
                'id' => 3,
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'subscriber',
                'created_at' => '2021-07-14 11:10:10',
                'updated_at'=> '2021-07-14 11:10:10'
            ]
            ];

            $post = [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'title' => 'Hello Word',
                    'body' => 'hello word',
                    'active' => 1,
                    'created_at' => '2021-07-14 09:29:18',
                    'updated_at'=> '2021-07-14 09:29:18'
                ],
                [
                    'id' => 2,
                    'user_id' => 2,
                    'title' => 'How are you?',
                    'body' => 'How are you?',
                    'active' => 1,
                    'created_at' => '2021-07-14 09:35:20',
                    'updated_at'=> '2021-07-14 09:35:20'
                ],
                [
                    'id' => 3,
                    'user_id' => 2,
                    'title' => 'What your name?',
                    'body' => 'What your name?',
                    'active' => 0,
                    'created_at' => '2021-07-14 09:40:25',
                    'updated_at'=> '2021-07-14 09:40:25'
                ]
                ];

                $comment = [
                    [
                        'id' => 1,
                        'user_id' => 2,
                        'body' => 'Im fine',
                        'post_id' => 2,
                        'created_at' => '2021-07-14 10:30:10',
                        'updated_at'=> '2021-07-14 10:30:10'
                    ]
                    ];

            DB::table('users')->insert($user);
            DB::table('posts')->insert($post);
            DB::table('comments')->insert($comment);
    }
}