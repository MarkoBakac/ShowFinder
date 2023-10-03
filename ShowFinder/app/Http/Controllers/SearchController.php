<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = strtolower($request->input('q'));

        $cachedResult = Cache::get('search_' . $query);

        if ($cachedResult) {
            return response()->json(['results' => $cachedResult], 200);
        }

        // HTTP GET request
        $response = Http::get('http://api.tvmaze.com/search/shows', [
            'q' => $query,
        ]);

        if ($response->successful()) {
            $shows = $response->json();

            // Include only an exact match
            $exactMatch = null;

            foreach ($shows as $show) {
                $showName = strtolower($show['show']['name']);
                if ($showName === $query) {
                    $exactMatch = [
                        'id' => $show['show']['id'],
                        'name' => $show['show']['name'],
                        'summary' => $show['show']['summary'],
                        'language' => $show['show']['language'],
                        'genres' => $show['show']['genres'],
                        'status' => $show['show']['status'],

                    ];
                    break;
                }
            }

            if ($exactMatch) {
                Cache::put('search_' . $query, [$exactMatch], now()->addHours(48));

                // Return results
                return response()->json(['results' => [$exactMatch]], 200);
            } else {
                // If no exact match
                return response()->json(['error' => 'No exact match found'], 404);
            }
        } else {
            // Handle API request failure
            return response()->json(['error' => 'Failed to fetch TV show data'], 500);
        }
    }
}
