<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class BukuControllerTest extends TestCase
{
    use RefreshDatabase; 
    // use DatabaseTransactions;
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
    dump(" Respon : " . $response->getstatusCode());
    dump("Buku sudah di add dan ada dalam halaman");
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
 public function test_validation_menerima_add_buku(){
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
 
 public function test_validation_delete_buku(){
    $buku = Book::create([
        'judul' => 'p',
        'penulis' => 'p',
        'deskripsi' => 'p',
    ]);
    
    $response = $this->delete(route('delete.buku', $buku->id));
    // testing kalau ngeroute redirect ke admin
    $response->assertRedirect(route('admin'));
    // testing kalau bukunya sudah ga ada di database
    $this->assertDatabaseMissing('books', ['id' => $buku->id]);
    dump("Buku sudah di terima,di delete, dan di hapus dari database");

 }

 public function test_validation_detail_buku(){
    $this->withoutMiddleware();
    $user = User::create([
        'name' => "user",
        'email' => "user@gmail.com",
        'password' => bcrypt("password"), 
    ]);
    $this->actingAs($user);
    // testing route 
    $buku = Book::create([
        'judul' => 'Testing Judul',
        'penulis' => 'Testing Penulis',
        'deskripsi' => 'Testing Deskripsi',
    ]);
    $response = $this->get(route('detail.buku',$buku->id));
    dump($response->getstatusCode());
    // pastikan status 200
    $response->assertStatus(200);
  // Pastikan konten buku terlihat di respons
  $response->assertSee('Testing Judul'); // Pastikan judul terlihat di halaman
  $response->assertSee('Testing Penulis'); // Pastikan penulis terlihat
  $response->assertSee('Testing Deskripsi'); // Pastikan deskripsi terlihat
  dump("Buku sudah dilihat dan ada dalam halaman");
 }
}