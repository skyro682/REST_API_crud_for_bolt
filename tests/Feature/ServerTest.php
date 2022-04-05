<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class ServerTest extends TestCase
{
    public function test_auth_is_working()
    {
        $response = $this->getJson('/api/server');
        $response->assertUnauthorized();
    }
    
    public function test_server_list_can_be_retrived()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->getJson('/api/server');
        $response->assertOk();
    }

    public function test_server_can_be_created()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->postJson('/api/server', ['name' => 'test']);
        $response->assertStatus(201);
    }

    public function test_single_server_can_be_retrived()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->getJson('/api/server/1');
        $response->assertOK();
    }

    public function test_server_can_be_updated()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->putJson('/api/server/1', ['name' => 'test2']);
        $response->assertOk();
    }

    public function test_bolt_list_can_be_retrived()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->getJson('/api/bolt');
        $response->assertOk();
    }

    public function test_bolt_can_be_created()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->postJson('/api/bolt', ['name' => 'test', 'enabled' => true, 'server_id' => "1"]);
        $response->assertStatus(201);
    }

    public function test_single_bolt_can_be_retrived()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->getJson('/api/bolt/1');
        $response->assertOK();
    }

    public function test_bolt_can_be_updated()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->putJson('/api/bolt/1', ['name' => 'test2', 'enabled' => true, 'server_id' => "1"]);
        $response->assertOk();
    }

    public function test_bolt_can_be_deleted()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->deleteJson('/api/bolt/1');
        $response->assertStatus(204);
    }

    public function test_server_can_be_deleted()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    
        $response = $this->deleteJson('/api/server/1');
        $response->assertStatus(204);
    }
}
