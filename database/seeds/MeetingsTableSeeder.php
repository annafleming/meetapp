<?php

use App\User;
use Illuminate\Database\Seeder;

class MeetingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meetings')->delete();
        $users = User::all();
        foreach ($users as $user) {
            $meeting = factory(\App\Meeting::class)->create();
            $randomUser = User::where('id','!=',$user->id)->orderBy(DB::raw('RAND()'))->first();
            $meeting->users()->attach([$user->id, $randomUser->id]);
            $meeting->save();
        }
    }
}
