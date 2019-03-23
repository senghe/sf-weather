<?php

declare(strict_types=1);

namespace Test\Domain;

use App\Domain\Exception\InvalidServerResponseException;
use App\Infrastructure\Doctrine\Query\Model\CheckWeatherModel;
use Tests\AbstractKernelTestCase;

class CheckWeatherModelTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_query_model(): void
    {
        $json = '{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0},"name":"Tarnów"}';
        $model = new CheckWeatherModel(json_decode($json));

        $this->assertEquals([
            'city' => "Tarnów",
            'coordinates' => [
                'longitude' => 50.01,
                'latitude' => 20.99,
            ],
            'weatherDescription' =>  [
                'short' => "Clear",
                'long' => "clear sky",
            ],
            'weatherDetails' => [
                'current' => 297.221,
                'min' => 297.221,
                'max' => 297.221,
                'pressure' => 1007,
                'humidity' => 40,
            ],
            'windDetails' => [
                'speed' => 3.17,
                'direction' => 6,
                'gust' => 30.0,
            ],
            'cloudDetails' => [
                'percentage' => 0,
            ],
        ], $model->toArray());
    }

    public function prepareData(): array
    {
        return [
            ['{"coord":{"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"deg":6.50165,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"gust":30},"clouds":{"all":0}}'],
            ['{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30}}'],
        ];
    }

    /**
     * @test
     * @dataProvider prepareData()
     */
    public function it_tests_query_model_exception($json): void
    {
        $this->expectException(InvalidServerResponseException::class);

        $model = new CheckWeatherModel(json_decode($json));
        $model->toArray();
    }

    /**
     * @test
     */
    public function it_tests_no_exception_thrown_when_no_gust_specified(): void
    {
        $json = '{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165},"clouds":{"all":0},"name":"Tarnów"}';

        $model = new CheckWeatherModel(json_decode($json));
        try {
            $this->assertFalse(empty($model->toArray()));
        } catch (InvalidServerResponseException $e) {
            $this->fail('Exception '.$e->getMessage().' was thrown');
        }
    }

    /**
     * @test
     */
    public function it_tests_default_name(): void
    {
        $json = '{"coord":{"lon":50.01,"lat":20.99},"weather":[{"main":"Clear","description":"clear sky"}],"main":{"temp":297.221,"pressure":1007.16,"humidity":40,"temp_min":297.221,"temp_max":297.221},"wind":{"speed":3.17,"deg":6.50165,"gust":30},"clouds":{"all":0}}';

        $model = new CheckWeatherModel(json_decode($json));
        $output = $model->toArray();

        $this->assertEquals("No city", $output['city']);
    }
}
