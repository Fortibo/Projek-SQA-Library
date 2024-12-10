<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class BukuControllerTest extends TestCase
{
    // use RefreshDatabase; 
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
public function test_post_method_dipanggil_create_buku(): void
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

    //  HTTP status code  200 (OK) / redirect (302)
    $response->assertStatus(302); // Ganti sesuai ekspektasi
    // $response->assertSee('/admin'); // Cek apakah view berhasil di redirect atau ditampilkan.

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
  dump("Buku sudah dilihat dan ada dalam halaman" );
 }
 public function test_untuk_boundary_value_kosong(){
    $this->withoutMiddleware();
    //  data 
     // Data input tidak valid
     $data = [
        'judul' => '', // Judul kosong
        'penulis' => '', // Penulis kosong
        'deskripsi' => '', // Deskripsi kosong
    ];
    $response = $this->post(route('insert.buku', $data));

    dump($response->getstatusCode());
    // untuk cek error apakah ada session errornya
    $response->assertSessionHasErrors(['judul']);
    $response->assertSessionHasErrors(['penulis']);
    $response->assertSessionHasErrors(['deskripsi']);
 }
 public function test_tidak_valid_jika_ada_judul_double(){
    Book::create([
        'judul' => 'Halo', // Judul sama
        'penulis' => 'Eric', // 
        'deskripsi' => 'blabla', // 
    ]);

    $newData = [
        'judul' => 'Halo', // Judul sama
        'penulis' => 'Eric',
        'deskripsi' => 'blabla' 
    ];
    $response = $this->post(route('insert.buku'),$newData);
    $response->assertSessionHasErrors(['judul']);
    $response->assertDontSee('Eric');
    $response->assertDontSee('blabla');

 }
 public function test_boundary_sama_untuk_judul__penulis__deskripsi(){
    $data = [
        "judul" => str_repeat('a',255),
        'penulis'=> str_repeat('b',255),
        'deskripsi'=>str_repeat('c',1000)
    ];
    // boundary pas 255,255,1000
    $response = $this->post(route('insert.buku'),$data);
    $this->assertDatabasehas('books',[
        'judul' => str_repeat('a', 255),
        'penulis' => str_repeat('b', 255),
        'deskripsi' => str_repeat('c', 1000),
    ]);
    $response->assertRedirect(route('admin'));
 }
 public function test_melebihi_boundary_untuk_penulis__judul__deskripsi(){
    $data = [
        "judul" => str_repeat('a',256),
        'penulis'=> str_repeat('b',256),
        'deskripsi'=>str_repeat('c',1001)
    ];
    $response = $this->post(route('insert.buku'),$data);
    $response->assertSessionHasErrors(['judul']);
    $response->assertSessionHasErrors(['penulis']);
    $response->assertSessionHasErrors(['deskripsi']);
 }
 public function test_input_buku_bahasa_lain() {
    $data = [
        'judul'=> '我欠你',
        'penulis' => 'ميسيل',
        'deskripsi'=> '할로 카무 칸틱 하리 이니'
    ];
    $response = $this->post(route('insert.buku'),$data);
      // Pastikan redirect berhasil
      $response->assertRedirect(route('admin'));
    $this->assertDatabasehas('books',[
        'judul' => '我欠你',
        'penulis' => 'ميسيل',
        'deskripsi' => '할로 카무 칸틱 하리 이니',
    ]);
 
 }
}