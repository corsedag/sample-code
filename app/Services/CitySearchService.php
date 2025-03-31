<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CitySearchService
{
    private $baseUrl = 'https://geocoding-api.open-meteo.com/v1/search';

    public function search($search_term)
    {
        try {
            // make the http call
            $res = Http::get($this->baseUrl, [
                'name' => $search_term,
            ]);

            // check if the call returned 200 OK
            if ($res->successful()) {
                // parse the response as json
                $cities = $res->object();

                return $cities->results ?? [];
            }

            // return an error if not successful
            return ['error' => 'Unable to get search for cities.'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}