<?php

declare(strict_types=1);

namespace Tests\Feature\DTOs;

use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewUserDTOTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_instance_created_from_form_request()
    {
        $dto = NewUserDTO::fromRequest(
            new SignUpFormRequest(
                SignUpFormRequest::factory()
                    ->create()
            )
        );

        $this->assertInstanceOf(NewUserDTO::class, $dto);
    }
}
