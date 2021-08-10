<?php

namespace Database\Seeders;

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
        \App\Models\Topic::factory()->times(10)->create(['user_id' => 2]);
        \App\Models\Topic::factory()->times(10)->create(['user_id' => 4]);
        \App\Models\Post::factory()->times(2)->create(['user_id' => 2, 'topic_id' => 4]);
        \App\Models\Post::factory()->times(2)->create(['user_id' => 4, 'topic_id' => 4]);
        \App\Models\Post::factory()->times(2)->create(['user_id' => 2, 'topic_id' => 5]);
        \App\Models\Post::factory()->times(2)->create(['user_id' => 4, 'topic_id' => 5]);
    }
}
