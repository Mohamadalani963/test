<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Repos\UserRepo;
use Illuminate\Database\Seeder;

class AuthSeeder extends Seeder
{
    private UserRepo $userRepository;

    public function __construct(UserRepo $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::where('username', 'admin')->first();
        if (! $user) {
            $user = $this->userRepository->store([
                'username' => 'admin',
                'type' => 'super_admin',
                'password' => '12345678',

            ]);
        }
        $role = Role::where('name', '*')->first();
        $abilities = $role->abilities->pluck('id');
        $user->abilities()->sync($abilities);
    }
}
