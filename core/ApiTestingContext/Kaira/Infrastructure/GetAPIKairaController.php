<?php

declare(strict_types=1);

namespace core\ApiTestingContext\Kaira\Infrastructure;

use Illuminate\Http\Request;
use Core\ApiTestingContext\Kaira\Application\GetAPIKairaUseCase;

final class GetAPIKairaController
{


    public function __invoke(Request $request)
    {
        $urlApi = 'https://tinyurl.com/api-create.php?url=';
        $urlCast = (string)$request->url;
        $getUserUseCase = new GetAPIKairaUseCase($urlApi, $urlCast);
        $apiCom         = $getUserUseCase->__invoke();

        return $apiCom;
    }
}