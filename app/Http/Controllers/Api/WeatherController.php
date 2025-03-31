<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    private $latitude = 40.44062;

    private $longitude = -79.99589;

    public function index(Request $request)
    {
        $service = new WeatherService;

        if ($request->filled('lat') && $request->filled('lon')) {
            $this->latitude = $request->get('lat');
            $this->longitude = $request->get('lon');
        }

        // coordinates are for Raleigh, NC
        $weather = $service->getWeather($this->latitude, $this->longitude );

        return response()->json($weather, 200);
    }
}
