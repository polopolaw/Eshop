<?php

declare(strict_types=1);

namespace Support\ValueObjects;

use Stringable;
use Support\Traits\Makeable;
use Support\ValueObjects\Exceptions\InvalidCurrency;

final class Currency implements Stringable
{
    use Makeable;

    private array $availableCurrencies = [
        'RUB',
        'USD'
    ];

    /**
     * @throws InvalidCurrency
     */
    public function __construct(
        private readonly string $key = 'RUB'
    ) {
        if (!in_array($this->key, $this->availableCurrencies)) {
            throw new InvalidCurrency("$this->key is not allowed currency code");
        }
    }

    public function symbol(): string
    {
        return match ($this->key) {
            'RUB' => '₽',
            'USD' => '$'
        };
    }

    public function code(): string
    {
        return $this->key;
    }

    public function __toString()
    {
        return $this->symbol();
    }
}
