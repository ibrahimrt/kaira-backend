<?php

declare(strict_types=1);

namespace Core\ApiTestingContext\Kaira\Domain;

use Core\ApiTestingContext\Kaira\Domain\ValueObjects\UrlApi;
use Core\ApiTestingContext\Kaira\Domain\ValueObjects\UrlCast;

final class Url
{
    private $urlapi;
    private $urlcast;    

    public function __construct(
        UrlApi $urlapi,
        UrlCast $urlcast
    )
    {
        $this->urlapi   = $urlapi;
        $this->urlcast  = $urlcast;
    }

    public function urlapi(): UrlApi
    {
        return $this->urlapi;
    }

    public function urlcast(): UrlCast
    {
        return $this->urlcast;
    }

    public static function create(
        UrlApi $urlapi,
        UrlCast $urlcast
    ): Url
    {
        $url = new self($urlapi, $urlcast);

        return $url;
    }
}