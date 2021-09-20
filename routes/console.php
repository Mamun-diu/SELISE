<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('user:create', function () {
    $name = $this->ask('Name?');
    $email = $this->ask('Email?');
    $pwd = $this->ask('Password?');
    \DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($pwd),
            'created_at' => date_create()->format('Y-m-d H:i:s'),
            'updated_at' => date_create()->format('Y-m-d H:i:s'),
    ]);
    $this->info('Account created for '.$name);
});
