<?php

use CEFE\BlogPost;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogPost::insert([
            [
                'user_id' => '1',
                'image' => 'default.jpg',
                'title' => 'Primeira Notícia',
                'body' => '<p>Olá Mundo! Bem-vindo ao sistema de notícias.</p>',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'user_id' => '1',
                'image' => 'default.jpg',
                'title' => 'Segunda Notícia',
                'body' => '<p>Olá Mundo! Bem-vindo ao sistema de notícias.</p>',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'user_id' => '1',
                'image' => 'default.jpg',
                'title' => 'Terceira Notícia',
                'body' => '<p>Olá Mundo! Bem-vindo ao sistema de notícias.</p>',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'user_id' => '1',
                'image' => 'default.jpg',
                'title' => 'Quarta Notícia',
                'body' => '<p>Olá Mundo! Bem-vindo ao sistema de notícias.</p>',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
        ]);

        // factory(BlogPost::class, 10)->create();
    }
}
