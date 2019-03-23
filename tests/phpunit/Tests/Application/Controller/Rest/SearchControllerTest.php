<?php

declare(strict_types=1);

namespace Tests\Application\Controller\Rest;

use Tests\AbstractWebTestCase;

final class SearchControllerTest extends AbstractWebTestCase
{
    protected $fixtureFile = 'Data/Application/Controller/Rest/SearchControllerTestFixtures.yaml';

    /**
     * @test
     */
    public function it_returns_weather_info(): void
    {

    }

    /**
     * @test
     */
    public function it_tells_that_location_is_not_found(): void
    {

    }
}
