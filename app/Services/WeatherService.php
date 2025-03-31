<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    private $baseUrl = 'https://api.open-meteo.com/v1/forecast';

    public function getWeather($latitude, $longitude)
    {
        try {
            // make the http call
            $res = Http::get($this->baseUrl, [
                'current' => [
                    'relative_humidity_2m',
                    'temperature_2m',
                    'weather_code',
                    'wind_direction_10m',
                    'wind_gusts_10m',
                    'wind_speed_10m',
                ],
                'latitude' => $latitude,
                'longitude' => $longitude,
                'precipitation_unit' => 'inch',
                'temperature_unit' => 'fahrenheit',
                'wind_speed_unit' => 'mph',
            ]);

            // check if the call returned 200 OK
            if ($res->successful()) {
                // parse the response as json
                $weather = $res->json();

                // add the weather description
                $weather['current']['description'] = $this->getWeatherDescription($weather['current']['weather_code']);

                return $weather;
            }

            // return an error if not successful
            return ['error' => 'Unable to get weather data.'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    private function getWeatherDescription($code)
    {
        // table can be found at:
        // https://open-meteo.com/en/docs#:~:text=WMO%20Weather%20interpretation%20codes%20(WW)

        // switch case to convert the code into a human readable description
        switch ((int) $code) {
            case 0:
                $description = 'Clear sky';
                break;

            case 1:
                $description = 'Mainly clear';
                break;

            case 2:
                $description = 'Partly cloudy';
                break;

            case 3:
                $description = 'Overcast';
                break;

            case 45:
                $description = 'Fog';
                break;

            case 48:
                $description = 'Depositing rime fog';
                break;

            case 51:
                $description = 'Light drizzle';
                break;

            case 53:
                $description = 'Moderate drizzle';
                break;

            case 55:
                $description = 'Dense drizzle';
                break;

            case 56:
                $description = 'Light freezing drizzle';
                break;

            case 57:
                $description = 'Dense freezing drizzle';
                break;

            case 61:
                $description = 'Slight rain';
                break;

            case 63:
                $description = 'Moderate rain';
                break;

            case 65:
                $description = 'Heavy rain';
                break;

            case 66:
                $description = 'Light freezing rain';
                break;

            case 67:
                $description = 'Heavy freezing rain';
                break;

            case 71:
                $description = 'Slight snowfall';
                break;

            case 73:
                $description = 'Moderate snowfall';
                break;

            case 75:
                $description = 'Heavy snowfall';
                break;

            case 77:
                $description = 'Snow grains';
                break;

            case 80:
                $description = 'Slight rain showers';
                break;

            case 81:
                $description = 'Moderate rain showers';
                break;

            case 82:
                $description = 'Violent rain showers';
                break;

            case 85:
                $description = 'Slight snow showers';
                break;

            case 86:
                $description = 'Heavy snow showers';
                break;

            case 95:
                $description = 'Thunderstorm: Slight or moderate';
                break;

            case 96:
                $description = 'Thunderstorm with slight hail';
                break;

            case 99:
                $description = 'Thunderstorm with heavy hail';
                break;

            default:
                $description = 'Unknown weather condition';
                break;
        }

        return $description;
    }
}
