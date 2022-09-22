<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Barang;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BarangTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     
     **/
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

    public function test_store_barang()
    {
        $response = $this->actingAs($this->user)
            ->get('/dashboard');
        $response->assertStatus(200);
        $response = $this->actingAs($this->user)->get('/barang');
        $response = $this->post('/barang', [
            'Kategori' => 1,
            'nama_barang' => 'Ghani',
            'harga' => 100,
            'stok' => 1,
            'keterangan' => 'Sembarang',
            'foto' => 'asset/img/user.png',
        ]);
        $response->assertSeeText('Ghani');
        $response->assertSeeText(100);
    }

    public function test_store_barang_invalid_input()
    {
        $response = $this->actingAs($this->user)
        ->get('/dashboard');
        $response->assertStatus(200);
        $response = $this->actingAs($this->user)->get('/barang');
        $response = $this->post('/barang', [
            'Kategori' => '',
            'nama_barang' => '',
            'harga' => '',
            'stok' => '',
            'keterangan' => '',
            'foto' => ''
        ]);
        $response->assertInvalid([
            'Kategori' => 'The kategori field is required.',
            'nama_barang' => 'The nama barang field is required.',
            'harga' => 'The harga field is required.',
            'stok' => 'The stok field is required.',
            'keterangan' => 'The keterangan field is required.',
            'foto' => 'The foto field is required'
        ]);
    }

    public function test_edit_data_barang_page()
    {
        $response = $this->actingAs($this->user)
        ->get('/dashboard');
        $response->assertStatus(200);
        $response = $this->actingAs($this->user)->get('/barang');
        $response = $this->post('/barang', [
            'Kategori' => 1,
            'nama_barang' => 'Ghani',
            'harga' => 100,
            'stok' => 1,
            'keterangan' => 'Sembarang',
            'gambar' => 'assets/img.jpg',
        ]);

        $response = $this->actingAs($this->user)->get('/barang/edit');
        $response->assertSeeText('Nama Barang');
        $response->assertSeeText('Ghani');
        $response = Barang::where('nama_barang', 'Ghani')->update(['nama_barang' => 'testEditBarang']);
        $response = $this->actingAs($this->user)->get('/barang');
        $response->assertDontSeeText('Ghani');
    }

    public function test_delete_barang()
    {
        $response = $this->actingAs($this->user)
            ->get('/dashboard');
        $response->assertStatus(200);
        $response = Barang::where('nama_barang', 'testEditBarang')->delete();
        $response = $this->actingAs($this->user)->get('/barang');
        $response->assertDontSeeText('testEditBarang');
    }

    

   
}
