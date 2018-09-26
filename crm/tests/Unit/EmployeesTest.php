<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Employees;

class EmployeesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example to check if employee is stored in database.
     *
     * @return void
     */
    public function testCheckForEmployeeCreation()
    {
        //Create company first(FOREIGN KEY Constraint)
        factory('App\Companies')->create();

        factory('App\Employees')->create();

        $this->assertCount(1, Employees::all());
    }
}
