<?php

declare(strict_types=1);

namespace Tests\Application\Controller\Rest;

use Symfony\Component\HttpFoundation\Response;
use Tests\AbstractWebTestCase;

final class SearchHistoryControllerTest extends AbstractWebTestCase
{
    protected $fixtureFile = 'Data/Application/Controller/Rest/SearchHistoryControllerFixtures.yaml';

    /**
     * @test
     */
    public function it_saves_search_history(): void
    {
        $data = [
            'city' => 'Warszawa',
            'longitude' => 21.017532,
            'latitude' => 52.237049,
            'shortDescription' => 'Sunny',
            'longDescription' => 'It\'s a beautifully day',
            'temperature' => 10.52,
            'temperatureMin' => 9.71,
            'temperatureMax' => 13.51,
            'pressure' => 1012,
            'humidity' => 32,
            'windSpeed' => 21.32,
            'windDirectionDegree' => 42,
            'windGust' => 12,
            'cloudPercentage' => 52,
        ];

        $this->client->request('POST', '/history', $data);
        $response = $this->client->getResponse();

        $this->assertResponse(
            $response,
            Response::HTTP_CREATED,
            'Response/Application/Controller/Rest/SearchHistoryController/it_saves_search_history.json'
        );
    }

    /**
     * @test
     */
    public function it_lists_search_history_on_first_page(): void
    {
        $data = [
            'page' => 1,
        ];
        $this->client->request('GET', '/history', $data);
        $response = $this->client->getResponse();

        $this->assertResponse(
            $response,
            Response::HTTP_OK,
            'Response/Application/Controller/Rest/SearchHistoryController/it_lists_search_history_on_first_page.json'
        );
    }

    /**
     * @test
     */
    public function it_lists_one_item_of_search_history_on_second_page(): void
    {
        $data = [
            'page' => 2,
        ];
        $this->client->request('GET', '/history', $data);
        $response = $this->client->getResponse();

        $this->assertResponse(
            $response,
            Response::HTTP_OK,
            'Response/Application/Controller/Rest/SearchHistoryController/it_lists_one_item_of_search_history_on_second_page.json'
        );
    }

    /**
     * @test
     */
    public function it_lists_no_search_history_on_third_page(): void
    {
        $data = [
            'page' => 3,
        ];
        $this->client->request('GET', '/history', $data);
        $response = $this->client->getResponse();

        $this->assertResponse(
            $response,
            Response::HTTP_OK,
            'Response/Application/Controller/Rest/SearchHistoryController/it_lists_no_search_history_on_third_page.json'
        );
    }

    /**
     * @test
     */
    public function it_lists_first_page_on_negative_page(): void
    {
        $data = [
            'page' => -1,
        ];
        $this->client->request('GET', '/history', $data);
        $response = $this->client->getResponse();

        $this->assertResponse(
            $response,
            Response::HTTP_OK,
            'Response/Application/Controller/Rest/SearchHistoryController/it_lists_search_history_on_first_page.json'
        );
    }

    /**
     * @test
     */
    public function it_shows_search_statistics(): void
    {
        $this->client->request('GET', '/history/statistics');
        $response = $this->client->getResponse();

        $this->assertResponse(
            $response,
            Response::HTTP_OK,
            'Response/Application/Controller/Rest/SearchHistoryController/it_shows_search_statistics.json'
        );
    }
}
