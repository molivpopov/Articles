<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(/** @lang text */"
            INSERT INTO users (name, email, role, password, remember_token) VALUES
            ('Димитър Попов', 'mitkop@mail.bg', 'admin', '$2y$10\$SWNbedaB.CVBy.Q1O3cusOIeixZ/yk4VRHQ1EUZUgriiGHWgfUnJ2', 'IFWsui49va3cnZkm2T3Lwek43aJLvFGTCkp2TdgZDmyvakvv7yevinWsHko8'),
            ('Димитър (USER)', 'al.gor@mail.bg', 'user', '$2y$10\$SWNbedaB.CVBy.Q1O3cusOIeixZ/yk4VRHQ1EUZUgriiGHWgfUnJ2', 'IFWsui49va3cnZkm2T3Lwek43aJLvFGTCkp2TdgZDmyvakvv7yevinWsHko8')
        ");
    }
}
