<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        // Category::truncate();
        // Post::truncate();

        $aUser = User::factory()->create([
            'name' => 'A. Smith'
        ]);

        Post::factory(30)->create();
        // Post::factory(5)->create([
        //     'user_id' => $aUser->id,
        // ]);

        // $user = User::factory()->create();

        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal',
        // ]);
        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work',
        // ]);
        // $hobby = Category::create([
        //     'name' => 'Hobby',
        //     'slug' => 'hobby',
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $personal->id,
        //     'title' => 'A peronal post',
        //     'slug' => 'personal-post-one',
        //     'excerpt' => 'This is a personal post.',
        //     'body' => 'This is a personal post. It talks about personal things. The things here are personal. So, it is a personal post. A personal post.'
        // ]);
        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $hobby->id,
        //     'title' => 'A hobby post',
        //     'slug' => 'hobby-post-one',
        //     'excerpt' => 'This is a hobby post.',
        //     'body' => 'This is a hobby post. It talks about hobby things. The things here are hobby. So, it is a hobby post. A hobby post.'
        // ]);
        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'A work post',
        //     'slug' => 'work-post-one',
        //     'excerpt' => 'This is a work post.',
        //     'body' => 'This is a work post. It talks about work things. The things here are work. So, it is a work post. A work post.'
        // ]);
    }
}
