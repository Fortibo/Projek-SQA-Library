<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserConrollerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_simple_login(): void
    {
        // testing untuk login pake akun dummy
        $user = User::create([
            'name'=> 'Benedict Edwin',
            'email'=>"pootisspy77@gmail.com",
            'password'=> bcrypt('Password123')
        ]);
        $p = $this->post(route('login'),[
            'email'=> $user->email,
            'password'=>'Password123'
        ]);
        $p->assertRedirect(route('user'));
        $p->assertSessionMissing('error');
        $this->assertAuthenticatedAs($user);
    }
    public function test_untuk_login_failed_salah_password(){
        $user = User::create([
            'name'=> 'Benedict Edwin',
            'email'=>"pootisspy17@gmail.com",
            'password'=> bcrypt('Password123')
        ]);
        $p = $this->post(route('login'),[
            'email'=> $user->email,
            'password'=>'Password12'
        ]);
        $p->assertRedirect();
        $p->assertSessionHas('error');
        // untuk menandakan bahwa blm login
        $this->assertGuest();
    }
    public function test_signup_validasi_sukses(){
        $user = [
            'name'=> 'Benedict Edwin',
            'email'=>"pootisspy27@gmail.com",
            'password'=> 'password123A'
        ];
        $response = $this->post(route('signup'),$user);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
        $response->assertSessionHas('success');
    }
    public function test_untuk_email_yang_sudah_ada(){
        $user = User::create([
            'name'=> 'Benedict Edwin',
            'email'=>"pootisspy37@gmail.com",
            'password'=> bcrypt('password123A')
        ]);
        $user1 = [
            'name'=> 'Benedict Edwin',
            'email'=>"pootisspy37@gmail.com",
            'password'=> 'password123A'
        ];
        $response = $this->post(route('signup'),$user1);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['email']);
    }
    public function test_untuk_signup_syarat_password_salah(){
        // pass yang bener : min 8 huruf, max 255, ada huruf besar 1, ada angka 1
        $user1 = [
            'name'=> 'Benedict Edwin',
            'email'=>"pootisspy2@gmail.com",
            'password'=> 'pass'
        ];
        $response = $this->post(route('signup'),$user1);
        $response->assertSessionHasErrorsIn('password.min');
        $response->assertSessionHasErrorsIn('password.regex');
        $response->assertSessionDoesntHaveErrors(['email']);
        $response->assertSessionDoesntHaveErrors('password.max');
    }
    public function test_cek_boundary_kosong_untuk_name_dan_email_dan_password(){
        $user1 = [
            'name'=> '',
            'email'=>"",
            'password'=> ''
        ];
        $response = $this->post(route('signup'),$user1);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['password']);
        $response->assertSessionHasErrors(['name']);
        $response->assertSessionHasErrors(['email']);
        $response->assertSessionHasErrorsIn('password.required');
        $response->assertSessionHasErrorsIn('name.required');
        $response->assertSessionHasErrorsIn('email.required');
    }
    public function test_signup_boundary_untuk_nama_dan_password(){
        $user1 = [
            'name'=> str_repeat('a',255),
            'email'=>"pootisspy211@gmail.com",
            'password'=> 'A1' .  str_repeat('a',253)
        ];
        $response = $this->post(route('signup'),$user1);
        $response->assertSessionHasNoErrors(['password']);
        $response->assertSessionHasNoErrors(['name']);
        $response->assertRedirect(route('login'));
    }
    public function test_signup_boundary_melebihi_user_password(){
        $user1 = [
            'name'=> str_repeat('a',256),
            'email'=>"pootisspy211@gmail.com",
            'password'=> 'A1' .  str_repeat('a',254)
        ];
        $response = $this->post(route('signup'),$user1);
        $response->assertSessionHasErrors(['password']);
        $response->assertSessionHasErrors(['name']);
        $response->assertSessionHasErrorsIn('password.max');
        $response->assertSessionHasErrorsIn('name.max');
        $response->assertRedirect();
    }
    public function test_signup_untuk_bahasa_lain(){
        $user1 = [
            'name'=> '艾瑞克',
            'email'=>"Эрик@gmail.com",
            'password'=> bcrypt('1A에릭에리카사사사사사스')
        ];
        $response = $this->post(route('signup'),$user1);
        // $response->assertSessionHasErrors(['password']);
        $this->assertDatabaseHas('users',[
            'name'=> '艾瑞克',
            'email'=>"Эрик@gmail.com",
           
        ]);
        $response->assertSessionHasNoErrors();
    }
    public function test_logout_user(){
        $user= User::create([
            'name'=> 'Benedict Edwin',
            'email'=>"pootisspy2111@gmail.com",
            'password'=> Hash::make('Password1')
        ]);
        
        $this->actingAs($user);
        $response = $this->post(route('logout'));
        $this->assertGuest();
    }
    
}
