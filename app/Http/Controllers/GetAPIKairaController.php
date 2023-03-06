<?php

namespace App\Http\Controllers;
use App\Http\Resources\KairaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Core\ApiTestingContext\Kaira\Infrastructure\GetAPIKairaController as KairaInfraestructure;

class GetAPIKairaController extends Controller
{
    /**
     * @var App\Core\ApiTestingContext\Kaira\Infrastructure\GetAPIKairaController
     */
    private $getApiKairaController;

    public function __construct()
    {
        $this->getApiKairaController = new KairaInfraestructure();
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Facades\Redirect
     */
    public function __invoke(Request $request)
    {        
        $urlTranspolation = new KairaResource($this->getApiKairaController->__invoke($request));
        $urlNormalize = $urlTranspolation->resource->normalize();
        $getUrlFromJson = json_decode($urlNormalize->getContent(), true);
        return redirect($getUrlFromJson['url']);
    }
}
