<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BarangTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
use RefreshDatabase;
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_render_home()
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_render_barang_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/barang')->assertStatus(200);
    }

    public function test_store_barang()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/barang', [
            'Kategori' => 1,
            'nama_barang' => 'Ghani',
            'harga' => 100,
            'stok' => 1,
            'keterangan' => 'Sembarang',
            'gambar' => 'assets/img.jpg',
        ]);
        $response->assertStatus(302);
    }

    public function test_store_barang_invalid_input()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/barang', [
            'Kategori' => '',
            'nama_barang' => '',
            'harga' => '',
            'stok' => '',
            'keterangan' => '',
        ]);
        $response->assertStatus(302);
        $response->assertInvalid([
            'Kategori' => 'The kategori field is required.',
            'nama_barang' => 'The nama barang field is required.',
            'harga' => 'The harga field is required.',
            'stok' => 'The stok field is required.',
            'keterangan' => 'The keterangan field is required.',
        ]);
    }

    public function test_delete_barang_by_id()
    {
        //setup
        $response = $this->post('/barang', [
            'Kategori' => 1,
            'nama_barang' => 'Ghani',
            'harga' => 100,
            'stok' => 1,
            'keterangan' => 'Sembarang',
            'gambar' => 'assets/img.jpg',
        ]);

        //do something
        $this->followingRedirects()->delete($barang->id);
        //assert
        $this->assertDatabaseMissing('barangs', $response->toArray());
    }

    public function test_delete_barangs_by_id()
    {
        //setup
        $barang = Barang::create([
            'Kategori' => 1,
            'nama_barang' => 'Ghani',
            'harga' => 100,
            'stok' => 1,
            // 'keterangan' => 'Sembarang',
            // 'gambar' => 'assets/img.jpg',
        ]);
        print_r($barang);
        //do something
        $this->followingRedirects()->delete($barang->id);
        //assert
        $this->assertDatabaseMissing('barangs', $barang->toArray());
    }

    public function test_render_kategori_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/kategori')->assertStatus(200);
    }

    public function test_store_kategori()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/barang', [
            'nama' => 'Kertas',
        ]);
        $response->assertStatus(302);
    }

    public function test_store_kategori_invalid_input()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/kategori', [
            'nama' => '',
        ]);
        $response->assertStatus(302);
        $response->assertInvalid([
            'nama' => 'The nama field is required.',
        ]);
    }
}
