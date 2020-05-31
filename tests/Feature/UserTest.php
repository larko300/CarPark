<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_logged_users_can_see_cars_home_page()
    {
        $this->get('/car')
            ->assertRedirect('/login');
    }

    public function test_user_assign_role_manager_after_registre()
    {
        Role::create(['name' => 'manager']);
        $this->post('/register', [
            'name' => 'test user',
            'email' => 'test@test.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'manager',
        ]);
        $this->assertNotEmpty(User::role('manager')->get());
    }

    public function test_user_assign_role_driver_after_registre()
    {
        Role::create(['name' => 'driver']);
        $this->post('/register', [
            'name' => 'test user',
            'email' => 'test@test.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'driver',
        ]);
        $this->assertNotEmpty(User::role('driver')->get());
    }
}
