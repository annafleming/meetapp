<?php
use Illuminate\Database\Seeder;
use App\User as User;

class UsersTableSeeder extends Seeder {


    public function run()
    {
        $users = array(
            array('name'=>'Adam Williams',
                'email' => 'awilliams@petsafe.net',
                'password' => bcrypt('secret')),
            array('name'=>'Anna Fleming',
                'email' => 'afleming@petsafe.net',
                'password' => bcrypt('secret')),
            array('name'=>'Anthony Garritano',
                'email' => 'agarritano@petsafe.net',
                'password' => bcrypt('secret')),
            array('name'=>'David Angel',
                'email' => 'dangel@petsafe.net',
                'password' => bcrypt('secret')),
            array('name'=>'Amos Garner',
                'email' => 'agarner@petsafe.net',
                'password' => bcrypt('secret')),
            array('name'=>'Everett Green',
                'email' => 'egreen@petsafe.net',
                'password' => bcrypt('secret')),
            array('name'=>'Joshua Jones',
                'email' => 'jj@petsafe.net',
                'password' => bcrypt('secret')),
            array('name'=>'Ryan Poe',
                'email' => 'rpoe@petsafe.net',
                'password' => bcrypt('secret')),
            array('name'=>'Henry Petry',
                'email' => 'hpetry@petsafe.net',
                'password' => bcrypt('secret')),
        );

        DB::table('users')->delete();
        DB::table('users')->insert($users);
    }

}
