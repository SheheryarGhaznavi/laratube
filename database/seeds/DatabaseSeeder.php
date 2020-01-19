<?php

use Illuminate\Database\Seeder;
use Laratube\Models\Channel;
use Laratube\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user1 = factory(User::class)->create([
            'email' => 'user1@gmail.com'
        ]);
        $user2 = factory(User::class)->create([
            'email' => 'user2@gmail.com'
        ]);


        $channel1 = $user1->channel()->create([
            'name' => $user1->name
        ]);
        $channel2 = $user2->channel()->create([
            'name' => $user2->name
        ]);


        // $channel1 = factory(Channel::class)->create([
        //     'user_id' => $user1->id
        // ]);
        // $channel2 = factory(Channel::class)->create([
        //     'user_id' => $user2->id
        // ]);


        $channel1->subscription()->create([
            'user_id' => $user2->id
        ]);
        $channel2->subscription()->create([
            'user_id' => $user1->id
        ]);
    }
}
