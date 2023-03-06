<?php

declare(strict_types=1);

namespace Core\ApiTestingContext\Kaira\Application;

use Core\ApiTestingContext\Kaira\Domain\Url;
use Core\ApiTestingContext\Kaira\Domain\ValueObjects\UrlApi;
use Core\ApiTestingContext\Kaira\Domain\ValueObjects\UrlCast;
use Core\ApiTestingContext\Kaira\Domain\ValueObjects\UrlResponseNormalized;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;

final class GetAPIKairaUseCase
{
    private $urlApi;
    private $urlCast;
    
    public function __construct(string $urlApi, string $urlCast)
    {
        $this->urlApi = $urlApi;
        $this->urlCast = $urlCast;
    }

    public function __invoke()
    {
        $urlApicasted = new UrlApi($this->urlApi);
        $urlcasted = new UrlCast($this->urlCast);        
        
        $finalUrl = $urlApicasted->value().$urlcasted->value();
        
        $bearer = '1|DLZw2t9fpdbmFhjjqLZB0EfM882eV7fizMIkX6KQ';
        
        $client = new Client([            
            'timeout'  => 2.0,
            // 'headers' => [
            //     'Authorization' => "Bearer ".$bearer.""
            // ]
        ]);
        $response = $client->request('GET', $finalUrl);
        
        $bodyUrl = $response->getBody()->read(100);
        
        $responseUrl = new UrlResponseNormalized($bodyUrl);
        
        return $responseUrl;
        
    }
}