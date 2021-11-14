<?php

declare(strict_types=1);

namespace App\Domain\News\Action\Upload;

use kp\MicroserviceApi\Exception\ApiException;
use kp\MicroserviceApi\ImportServiceApi\Client as ImportClient;
use kp\MicroserviceApi\ImportServiceApi\News\Request\UploadRequest;

class UploadAction
{
    /**
     * @var ImportClient
     */
    private ImportClient $importClient;

    /**
     * @param ImportClient $importClient
     */
    public function __construct(ImportClient $importClient)
    {
        $this->importClient = $importClient;
    }

    /**
     * @throws \Exception
     */
    public function execute()
    {
        try {
            $this->importClient->upload()->upload(new UploadRequest());

        } catch (ApiException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

        return null;
    }
}