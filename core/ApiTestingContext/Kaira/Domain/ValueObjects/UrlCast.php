<?php

declare(strict_types=1);

namespace core\ApiTestingContext\Kaira\Domain\ValueObjects;


final class UrlCast
{
    private $value;

    /**
     * UrlCast constructor.
     * @param string $cast
     */
    public function __construct(string $cast)
    {
        $this->validate($cast);
        $this->value = $cast;
    }

    /**
     * @param string $cast
     * @throws InvalidArgumentException
     */
    private function validate(string $cast): void
    {
        if (!filter_var($cast, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the invalid url: <%s>.', static::class, $cast)
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}