<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Companies;
use App\Employees;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeesFlow extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example to test Employees controller flow
     *
     * @return void
     */
    public function testEmployeesIndex()
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
                ->get(route('employees.index'))
                ->assertViewIs('employees.index')
                ->assertStatus(200);
    }

    public function testEmployeesShow()
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
        $employee = factory(Employees::class)->create();

        $response = $this
                ->actingAs($user)
                ->get('/employees/'.$employee->id)
                ->assertViewIs('employees.show')
                ->assertStatus(200)
                ->assertSee($employee->first_name)
                ->assertSee($employee->last_name)
                ->assertSee($employee->email)
                ->assertSee($employee->phone);
    }

    public function testEmployeesEdit()
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
        $employee = factory(Employees::class)->create();

        $response = $this
                ->actingAs($user)
                ->get('/employees/'.$employee->id.'/edit')
                ->assertViewIs('employees.edit')
                ->assertStatus(200)
                ->assertSee($employee->first_name)
                ->assertSee($employee->last_name)
                ->assertSee($employee->email)
                ->assertSee($employee->phone)
                ->assertSee($company->name);
    }

    public function testEmployeesDelete()
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
        $employee = factory(Employees::class)->create();

        $response = $this
                ->actingAs($user)
                ->delete('/employees/'.$company->id)
                ->assertRedirect(route('employees.index'));
    }
}
