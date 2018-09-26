<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Companies;

class CompaniesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example to check if company is stored in database.
     *
     * @return void
     */
    public function testCheckForCompanyCreation()
    {
        factory('App\Companies')->create();
        $this->assertCount(1, Companies::all());
    }
}
