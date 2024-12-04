<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class BukuControllerTest extends TestCase
{
    
    use DatabaseTransactions;
    /**
     * Test validation fails when 'penulis' field is missing.
     */
    
//     public function test_basic(): void
// {
//     $this->assertTrue(true);
// }
// public function test_validation_menerima_add_buku(): void
// {
//     dump('Metode dijalankan');
//     $this->assertTrue(true);
// }
public function test_post_method_is_called(): void
{
    // Buat user untuk otentikasi (jika diperlukan)
    $user = User::factory()->create();

    // Simulasi pengiriman POST request ke rute yang ingin diuji
    $response = $this->post('/add/buku', [
        'judul' => 'Buku Baru',
        'penulis' => 'Penulis Baru',
        'deskripsi' => 'Deskripsi Buku Baru'
    ]);

    // Dump responsenya untuk memastikan data dikembalikan
    dump($response->getstatusCode());

    // Pastikan HTTP status code adalah 200 (OK) atau redirect (302)
    $response->assertStatus(302); // Ganti sesuai ekspektasi
    // $response->assertSee('/admin'); // Cek apakah view berhasil di-redirect atau ditampilkan.

    // Pastikan data masuk ke database (jika database testing diaktifkan)
    $this->assertDatabaseHas('books', [
        'judul' => 'Buku Baru',
        'penulis' => 'Penulis Baru',
        'deskripsi' => 'Deskripsi Buku Baru'
    ]);
}
 public function test_buku(){
    // testing route
    $this->withoutMiddleware();

    $response = $this->post('/add/buku', [
        'judul' => 'p',
        'penulis' => 'p',
        'deskripsi' => 'p',
    ]);

    // dump($response);
    $response->assertStatus(302);
 }
//  public function test_detail_buku(){
//     $this->withoutMiddleware();
    
//     $r = $this->get('/edit/buku/1');
//     dump($r->getContent());
//     $r->assertStatus(302);
//  }
}