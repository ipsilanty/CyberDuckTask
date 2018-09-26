<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Companies;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompaniesFlow extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic test example to test Companies controller flow
     *
     * @return void
     */
    public function testCompaniesIndex()
    {
        $adminEmail = 'admin@admin.com';
        $adminPass = bcrypt('password');

        //Override the default factory method
        $overrides = [
            'email' => $adminEmail,
            'password' => $adminPass
        ];

        $user = factory(User::class)->create($overrides);

        $response = $this
                ->actingAs($user)
                ->get(route('companies.index'))
                ->assertViewIs('companies.index')
                ->assertStatus(200);
    }

    public function testCompaniesShow()
    {
        $adminEmail = 'admin@admin.com';
        $adminPass = bcrypt('password');

        //Override the default factory method
        $overrides = [
            'email' => $adminEmail,
            'password' => $adminPass
        ];

        $user = factory(User::class)->create($overrides);
        $company = factory(Companies::class)->create();

        $response = $this
                ->actingAs($user)
                ->get('/companies/'.$company->id)
                ->assertViewIs('companies.show')
                ->assertStatus(200)
                ->assertSee($company->name)
                ->assertSee($company->email)
                ->assertSee($company->website)
                ->assertSee($company->logo);
    }

    public function testCompaniesEdit()
    {
        $adminEmail = 'admin@admin.com';
        $adminPass = bcrypt('password');

        //Override the default factory method
        $overrides = [
            'email' => $adminEmail,
            'password' => $adminPass
        ];

        $user = factory(User::class)->create($overrides);
        $company = factory(Companies::class)->create();

        $response = $this
                ->actingAs($user)
                ->get('/companies/'.$company->id.'/edit')
                ->assertViewIs('companies.edit')
                ->assertStatus(200)
                ->assertSee($company->name)
                ->assertSee($company->email)
                ->assertSee($company->website)
                ->assertSee($company->logo);
    }

    public function testCompaniesDelete()
    {
        $adminEmail = 'admin@admin.com';
        $adminPass = bcrypt('password');

        //Override the default factory method
        $overrides = [
            'email' => $adminEmail,
            'password' => $adminPass
        ];

        $user = factory(User::class)->create($overrides);
        $company = factory(Companies::class)->create();

        $response = $this
                ->actingAs($user)
                ->delete('/companies/'.$company->id)
                ->assertRedirect(route('companies.index'));
    }
}
