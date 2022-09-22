<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;

class RenderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    use WithoutMiddleware;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }

    private function createUser()
    {
        return $user = User::factory()->create([
        ]);

        Role::factory()->create([
            'name' => 'admin'
        ]);

        RoleUser::factory()->create([
            'user_id' => '1',
            'role_id' => '1'
        ]);

        $response = $this->actingAs($this->user)
        ->withSession(['data' => 'session']);
    }

    public function test_render_home()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('Login');
        $response->assertSeeText('About');
        $response->assertSeeText('Register');
    }

    public function test_render_barang_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSeeText('List Barang');
        $response = $this->actingAs($this->user)->get('/barang');
    }

    public function test_render_kategori_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSeeText('List Kategori');
        $response = $this->actingAs($this->user)->get('/kategori');
    }
}
