<?php

declare(strict_types=1);

namespace Tests\Unit\Support\ValueObjects;

use InvalidArgumentException;
use Support\ValueObjects\Exceptions\InvalidCurrency;
use Support\ValueObjects\Price;
use Tests\TestCase;

class PriceTest extends TestCase
{
    public function test_all()
    {
        $price = Price::make(value: 10000, precision: 100, currency: 'RUB');

        $this->assertEquals($price->value(), 100);
        $this->assertEquals($price->currencySymbol(), '₽');
        $this->assertEquals($price->raw(), 10000);
        $this->assertEquals($price->currency(), 'RUB');
        $this->assertEquals($price, '100 ₽');

        $this->expectException(InvalidCurrency::class);
        Price::make(value: 10000, currency: 'RUB');

        $this->expectException(InvalidArgumentException::class);
        Price::make(value: -10000);
    }
}
