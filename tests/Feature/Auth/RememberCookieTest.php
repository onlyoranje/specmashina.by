<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RememberCookieTest extends TestCase
{
    use RefreshDatabase;

    private function setCookies($response): array
    {
        return $response->headers->all()['set-cookie'] ?? [];
    }

    public function test_remember_me_cookie_is_set_when_checked(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'remember' => true,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $cookies = $this->setCookies($response);
        $this->assertNotEmpty(array_filter($cookies, fn ($c) => str_starts_with($c, 'remember_web_')),
            'Ожидалась remember-кука, но её нет в Set-Cookie: '.json_encode($cookies));
    }

    public function test_no_remember_cookie_when_unchecked(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $cookies = $this->setCookies($response);
        $this->assertEmpty(array_filter($cookies, fn ($c) => str_starts_with($c, 'remember_web_')));
    }
}
