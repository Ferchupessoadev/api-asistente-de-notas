<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user-admin {username} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for create user admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $password = $this->secret("Contraseña para el nuevo usuario admin");

        $user = User::create([
            'name' => $this->argument('username'),
            'email' => $this->argument('email'),
            'email_verified_at' => now(),        
            'password' => Hash::make($password),
        ]);

        $user->assignRole('user');
        $user->assignRole('teacher');
        $user->assignRole('admin');

        $this->info("Usuario admin creado.");
    }
}
