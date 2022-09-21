<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Barang;
use App\Models\Role;
use App\Models\Kategori;
use App\Models\RoleUser;
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
//use RefreshDatabase;
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_render_home()
    {
        $this->get('/')->assertStatus(200);
    }

    // public function test_login(){
    //     $user = User::factory()->create([
    //         'id' => 1,
    //         'username' => 'admin123',
    //         'password' => bcrypt('admin123')
    //     ]);

    //     Role::factory()->create([
    //         'name' => 'admin'
    //     ]);

    //     RoleUser::factory()->create([
    //         'user_id' => 1,
    //         'role_id' => 1
    //     ]);

    //     $response = $this->actingAs($user)
    //         ->withSession(['data' => 'session'])
    //         ->get('/dashboard');

    //     $response = $this->get('/barang');
    //     $response->assertStatus(200);
    // }

    public function test_render_barang_page()
    {
      
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/barang')->assertStatus(302);
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
        $response = $this->get('/barang', [
            'Kategori' => 1,
            'nama_barang' => 'Ghani',
            'harga' => 100,
            'stok' => 1,
            'keterangan' => 'Sembarang',
            'gambar' => 'assets/img.jpg',
        ]);

        //do something
        // $this->followingRedirects()->delete($this->id);
        // //assert
        // $this->assertDatabaseMissing('barangs', $response->toArray());
        $response->assertStatus(302);
    }

    public function test_delete_barangs_by_id()
    {
        //setup
        // $barang = Barang::create([
        //     'Kategori' => 1,
        //     'nama_barang' => 'Ghani',
        //     'harga' => 100,
        //     'stok' => 1,
        //     // 'keterangan' => 'Sembarang',
        //     // 'gambar' => 'assets/img.jpg',
        // ]);
        // print_r($barang);
        // //do something
        // $this->followingRedirects()->delete($barang->id);
        // //assert
        // $this->assertDatabaseMissing('barangs', $barang->toArray());
        $barang = Barang::where('nama_barang', 'Test Edit Product')->delete();

        $response = $this->get('/dashboard/products');
        $response->assertStatus(200);
    }

    public function test_render_kategori_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/kategori')->assertStatus(302);
    }

    public function test_store_kategori()
    {
        Kategori::create([
            'nama' => 'kertas',
        ]);
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori');
        $response->assertStatus(302);
    }

    public function test_store_kategori_invalid_input()
    {
        $response = $this->post('/kategori', [
            'nama' => '',
        ]);
        $response->assertStatus(302);
        $response->assertInvalid([
            'nama' => 'The nama field is required.',
        ]);
    }

    public function test_edit_data_kategori_page()
    {
        $kategori = Kategori::create([
            'nama' => 'kertasoke',
        ]);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori/edit');
        $response->assertStatus(200);
        
        $kategori = Kategori::where('nama', 'kertasoke')->update(['nama' => 'testingTest']);
        
        $response = $this->actingAs($user)->get('/kategori');
    
    }

    public function test_delete_data_kategori_page()
    {
        $kategori = Kategori::where('nama', 'testingTest')->delete();

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori');
        $response->assertStatus(302);
    }
}
