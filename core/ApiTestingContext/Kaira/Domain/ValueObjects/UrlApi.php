<?php

declare(strict_types=1);

namespace core\ApiTestingContext\Kaira\Domain\ValueObjects;


final class UrlApi
{
    private $value;

    /**
     * UrlApi constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->validate($url);
        $this->value = $url;
    }

    /**
     * @param string $url
     * @throws InvalidArgumentException
     */
    private function validate(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the invalid url: <%s>.', static::class, $url)
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}