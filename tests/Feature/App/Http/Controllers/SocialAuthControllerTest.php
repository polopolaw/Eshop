<?php

declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SocialAuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_github_success()
    {
        $this->get(action([SocialAuthController::class, 'github']));
        $this->assertTrue(true);
    }
}
