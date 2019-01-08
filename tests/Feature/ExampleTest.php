<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $company = factory(\App\Company::class)->create();
        $user = factory(\App\User::class)->create(['company_id' => $company->id]);
        $this->actingAs($user);
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
