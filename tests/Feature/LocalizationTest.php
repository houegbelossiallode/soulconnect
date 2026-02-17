<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LocalizationTest extends TestCase
{
    /**
     * Test que la langue change via la session.
     */
    public function test_can_switch_language()
    {
        $response = $this->get('/lang/es');

        $response->assertRedirect();
        $this->assertEquals('es', session('locale'));
    }

    /**
     * Test que le middleware SetLocale applique la langue de la session.
     */
    public function test_middleware_applies_locale()
    {
        $this->withSession(['locale' => 'es'])
             ->get('/')
             ->assertOk();

        $this->assertEquals('es', app()->getLocale());
    }

    /**
     * Test que les traductions JSON fonctionnent.
     */
    public function test_json_translations_work()
    {
        $this->withSession(['locale' => 'fr'])->get('/');
        $this->assertEquals('Bienvenue', __('Welcome'));

        $this->withSession(['locale' => 'es'])->get('/');
        $this->assertEquals('Bienvenido', __('Welcome'));
    }
}
