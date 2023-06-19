<?php
namespace Tests\Feature;
use Tests\TestCase;
class WebApplicationTest extends TestCase
{
    public function testHomePage()
    {
        $response = $this->get('/');
        
        $response->assertStatus(200);
        $response->assertSeeText('Welcome to house for rent');
    }
    public function testLogin()
    {
        $response = $this->post('/login-page', [
            'email' => 'ckg4155@gmail.com',
            'password' => 'Ketan@123',
        ],[
            'X-CSRF-TOKEN' => csrf_token(),
        ]);
        
        $response->assertStatus(200);
        $response->assertSeeText('owner');
    }
}
