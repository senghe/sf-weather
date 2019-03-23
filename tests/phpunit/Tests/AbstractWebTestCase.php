<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\DbUnit\Database\DefaultConnection;
use PHPUnit\DbUnit\DataSet\ArrayDataSet;
use PHPUnit\DbUnit\DataSet\CompositeDataSet;
use PHPUnit\DbUnit\DataSet\YamlDataSet;
use PHPUnit\DbUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Client;

class AbstractWebTestCase extends WebTestCase
{
    use TestCaseTrait;

    /**
     * @var string|null
     */
    protected $fixtureFile = null;

    /**
     * @var \Pdo
     */
    private $pdo;

    /**
     * @var DefaultConnection
     */
    private $connection;

    /**
     * @var Client
     */
    protected $client;

    public function setUp(): void
    {
        $this->getDatabaseTester()->setSetUpOperation($this->getSetUpOperation());
        $this->getDatabaseTester()->setDataSet($this->getDataSet());
        $this->getDatabaseTester()->onSetUp();

        $this->client = $this->createClient();
        $this->client->setServerParameters([
            'HTTP_ACCEPT' => 'application/json',
            'HTTP_HOST' => \getenv('APP_HOST'),
        ]);
    }

    protected function getConnection()
    {
        $dbUrl = getenv('DATABASE_URL');

        if ($this->connection === null) {
            if ($this->pdo === null) {
                $config = parse_url($dbUrl);
                $config['database'] = ltrim($config['path'], '/');

                if ($config['scheme'] === null) {
                    $config['scheme'] = 'mysql';
                }
                $this->pdo = new \Pdo(
                    ''.$config['scheme'].':host='.$config['host'].';dbname='.$config['database'].';charset=utf8',
                    $config['user'],
                    $config['pass']
                );
            }
            $this->connection = $this->createDefaultDBConnection($this->pdo);
        }

        return $this->connection;
    }

    protected function getDataSet()
    {
        if ($this->fixtureFile === null) {
            return new ArrayDataSet([]);
        }

        $compositeDs = new CompositeDataSet();
        $dataSet = new YamlDataSet(getenv('ROOT_DIR').'/'.$this->fixtureFile);
        $compositeDs->addDataSet($dataSet);

        return $compositeDs;
    }

    protected function assertResponse(Response $response, int $statusCode, string $filepath = null): void
    {
        $this->assertEquals($statusCode, $response->getStatusCode(), $response->getContent());

        if ($statusCode === Response::HTTP_NO_CONTENT) {
            return;
        }

        if ($filepath !== null) {
            $this->assertResponseContent($response->getContent(), $filepath);
        }
    }

    private function assertResponseContent(string $actualResponse, string $filepath): void
    {
        $filePath = getenv('ROOT_DIR').$filepath;

        if (!file_exists($filePath)) {
            $this->fail('Response file not found: '.$filePath);
        }

        $expectedResponse = $this->prettyJson(file_get_contents($filePath));
        $actualResponse = $this->prettyJson($actualResponse);

        $this->assertEquals($expectedResponse, $actualResponse);
    }

    private function prettyJson(string $json): string
    {
        return json_encode(json_decode(trim($json)), JSON_PRETTY_PRINT);
    }
}
