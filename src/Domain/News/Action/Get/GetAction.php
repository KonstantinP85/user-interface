<?php

declare(strict_types=1);

namespace App\Domain\News\Action\Get;

use kp\MicroserviceApi\Exception\ApiException;
use kp\MicroserviceApi\ImportServiceApi\Client;
use kp\MicroserviceApi\ImportServiceApi\News\Request\GetRequest;

class GetAction
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function execute(int $id) : array
    {
        try {
            $response = $this->client->get()->get((new GetRequest())->setId($id));

        } catch (ApiException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

        $result = [
            "id" => $response->getId(),
            "category" => $response->getCategory(),
            "datetime" => (new \DateTime())->setTimestamp($response->getDatetime())->format('Y-m-d H:i:s'),
            "headline" => $response->getHeadline(),
            "source_id" => $response->getSourceId(),
            "image" => $response->getImage(),
            "related" => $response->getRelated(),
            "resource" => $response->getResource(),
            "summary" => $response->getSummary(),
            "url" => $response->getUrl(),
        ];

        return $result;
    }
}