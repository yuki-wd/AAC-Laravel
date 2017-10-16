<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = \Faker\Factory::create();

        $user = new \App\User();
        $user->name = $faker->name;
        $user->email = $faker->unique()->safeEmail;
        $user->password = bcrypt('password');
        $user->remember_token = str_random(10);
        $user->save();

        $item = new \App\Item();
        $item->user_id = $user->id;
        $item->content = $faker->text();
        $item->save();

        $test = new \App\Test();
        $test->title = $faker->text();
        $test->save();

        for ($i=0; $i < 5; $i++) {
            $question = new \App\Question();
            $question->content = $faker->text();
            $question->test_id = $test->id;
        }

        // for ($s=0; $s < 4; $s++) {
        //     $option = new \App\Option();
        //     $option->
        // }
    }
}
