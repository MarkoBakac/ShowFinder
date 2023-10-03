<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    public function testValidQueryReturns200AndJsonResponse()
    {
        $response = $this->get('/api/search?q=deadwood');

        $response->assertStatus(200);

        $jsonResponse = $response->json();

        // Perform assertions on the JSON data
        $this->assertArrayHasKey('results', $jsonResponse);
        $this->assertIsArray($jsonResponse['results']);

        // Check the count of results
        $this->assertCount(1, $jsonResponse['results']);
    }
}


