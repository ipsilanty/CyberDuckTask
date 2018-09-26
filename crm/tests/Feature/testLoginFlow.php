<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class testLoginFlow extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example to test login flow
     *
     * @return void
     */

    //Test if user can see the view
    public function testUserCanSeeView()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    //Test if user can login with correct credentials 
    public function testUserCanLoginWithCorrectCredentials()
    {
        $password = bcrypt('password');
        $user = factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => $password
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/');
        $this->actingAs($user);
    }

    //Test if login fail with incorrect password
    public function testUserCannotLoginWithIncorrectPassword()
    {
        $password = bcrypt('password');
        $user = factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => $password
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'fakepassword',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
