<?php

use Illuminate\Database\Seeder;

class MemosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 1)->create();
        $users->each(function (App\User $user) {
            $user->memos()->saveMany(factory(App\Eloquents\Memo::class, 30)->make(['user_id' => null]));
        });
    }
}
