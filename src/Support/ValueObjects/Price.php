<?php

declare(strict_types=1);

namespace Support\ValueObjects;

use InvalidArgumentException;
use Support\Traits\Makeable;

final class Price
{
    use Makeable;

    private readonly Currency $currency;

    public function __construct(
        private readonly int $value,
        private readonly int $precision = 100,
        $currency = null,
    ) {
        if ($this->value < 0) {
            throw new InvalidArgumentException();
        }

        $this->currency = $currency ? Currency::make($currency) : Currency::make();
    }

    public function raw(): int
    {
        return $this->value;
    }

    public function value(): float|int
    {
        return $this->value / $this->precision;
    }

    public function currency(): string
    {
        return $this->currency->code();
    }

    public function currencySymbol(): string
    {
        return $this->currency->symbol();
    }

    public function precision(): int
    {
        return $this->precision;
    }

    public function __toString(): string
    {
        return number_format(
                $this->value(),
                $this->precision() % 10,
                thousands_separator: ' '
            ) . ' ' . $this->currencySymbol();
    }
}
