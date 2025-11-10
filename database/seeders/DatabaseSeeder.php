<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'ferchodev',
            'email' => 'fernandomatiaspessoa471@gmail.com',
            'password' => Hash::make('123ferchu')
        ]);
        
       

        $users = User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
            SubjectSeeder::class,
        ]);

        foreach ($users as $userTeacher) {
            $userTeacher->syncRoles(['user', 'teacher']);
        }

       

        $user->assignRole('admin');
        $user->assignRole('teacher');
        $user->assignRole('user');
    }
}
