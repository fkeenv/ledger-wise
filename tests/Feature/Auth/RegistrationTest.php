<?php

namespace Tests\Feature\Auth;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $faker = Factory::create();
        $response = $this->post('/register', [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'site_name' => 'tenant_' . mb_strtolower($faker->name),
        ]);

        // TODO: Fix me
        // $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
