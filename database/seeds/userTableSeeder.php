<?php

use Illuminate\Database\Seeder;
use App\User;
//use \Chat;
use Musonza\Chat\Chat ;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_EN');
        for ($i = 0; $i < 1; $i++) {
            $user = new User;
            $user->name = $faker->lastName.' '.$faker->firstName;
            $user->email = $faker->unique()->email;
            $user->password = bcrypt('123456789');
            $user->save();
        }
        $user = User::find(1);
        for ($i = 10; $i < 61; $i++) {
            $other = User::find($i);
            $participants = [$user, $other];
            $conversation = Chat::createConversation($participants)->makePrivate();
            $data = [
                'title' => $faker->title,
                 'description' => $faker->description
                ];
            $conversation->update(['data' => $data]);
        }
    }
}
