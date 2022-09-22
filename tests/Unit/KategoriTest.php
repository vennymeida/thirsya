<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Kategori;
use App\Models\RoleUser;

class KategoriTest extends TestCase
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

    public function test_store_kategori()
    {
        $response = $this->actingAs($this->user)
            ->get('/dashboard');
        $response->assertStatus(200);
        $response = $this->actingAs($this->user)->get('/kategori');
        $response = $this->post('/kategori', [
            'nama' => 'kertas',
        ]);
        $response = $this->actingAs($this->user)->get('/kategori');
        $response->assertSee('refresh');
    }

    public function test_store_kategori_invalid_input()
    {
        $response = $this->actingAs($this->user)
        ->get('/dashboard');
        $response->assertStatus(200);
        $response = $this->actingAs($this->user)->get('/kategori');
        $response = $this->post('/kategori', [
            'nama' => '',
        ]);
        $response->assertInvalid([
            'nama' => 'The nama field is required.',
        ]);
    }

    public function test_edit_data_kategori_page()
    {
        $response = $this->actingAs($this->user)
        ->get('/dashboard');
        $response->assertStatus(200);
        $response = $this->actingAs($this->user)->get('/kategori');
        $response = $this->post('/kategori', [
            'nama' => 'kertas',
        ]);
        $response = $this->actingAs($this->user)->get('/kategori/edit');
        $response = Kategori::where('nama', 'kertas')->update(['nama' => 'testEditKategori']);
        $response = $this->actingAs($this->user)->get('/kategori');
        $response->assertDontSeeText('kertas');
    }

    public function test_delete_data_kategori_page()
    {
        $kategori = Kategori::where('nama', 'testingTest')->delete();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori');
        $response->assertStatus(302);
        $response = $this->actingAs($this->user)
            ->get('/dashboard');
        $response->assertStatus(200);
        $response = Kategori::where('nama', 'testEditKategori')->delete();
        $response = $this->actingAs($this->user)->get('/kategori');
        $response->assertDontSeeText('testEditKategori');
    }
}
