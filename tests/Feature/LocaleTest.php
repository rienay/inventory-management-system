<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocaleTest extends TestCase
{
    public function test_can_switch_to_indonesian(): void
    {
        $response = $this->get(route('locale.switch', 'id'));

        $response->assertSessionHas('locale', 'id');
        $response->assertCookie('locale', 'id');
    }

    public function test_can_switch_to_english(): void
    {
        $response = $this->get(route('locale.switch', 'en'));

        $response->assertSessionHas('locale', 'en');
        $response->assertCookie('locale', 'en');
    }

    public function test_invalid_locale_is_ignored(): void
    {
        $response = $this->get(route('locale.switch', 'fr'));

        $response->assertSessionMissing('locale');
    }
}

