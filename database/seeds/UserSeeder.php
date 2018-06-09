<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>'Luis Canales',
            'email' =>'luis.canalesv@mail.udp.cl',
            'password' =>bcrypt('udp.2018')
        ]);

        User::create([
            'name' =>'Fernando Peña',
            'email' =>'fernando.penas@mail.udp.cl',
            'password' =>bcrypt('udp.2018')
        ]);

        User::create([
            'name' =>'Nicolás Pino',
            'email' =>'nicolas.pinol@mail.udp.cl',
            'password' =>bcrypt('udp.2018')
        ]);

        User::create([
            'name' =>'Jorge Elliott',
            'email' =>'jorge.elliott@mail.udp.cl',
            'password' =>bcrypt('udp.2018')
        ]);
    }
}
