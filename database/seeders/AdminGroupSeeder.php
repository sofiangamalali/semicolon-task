<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group = Group::create([
            'name' => 'admin',
            'description' => 'This group has all permissions'
        ]);

        $group->permissions()->attach(Permission::pluck('id'));

        $users = User::where('role', 'admin')->get();
        foreach ($users as $user) {
            $user->groups()->attach($group->id);
        }
    }
}
