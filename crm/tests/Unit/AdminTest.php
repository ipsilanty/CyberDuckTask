<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example to check if user is stored in database.
     *
     * @return void
     */
    public function testCheckForUserCreation()
    {
        $adminEmail = 'admin@admin.com';
        $adminPass = bcrypt('password');

        //Override the default factory method
        $overrides = [
            'email' => $adminEmail,
            'password' => $adminPass
        ];

        factory('App\User')->create($overrides);

        $this->assertDatabaseHas('users', $overrides);
    }
}
