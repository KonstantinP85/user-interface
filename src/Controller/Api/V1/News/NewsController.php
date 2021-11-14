<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\News;

use App\Domain\News\Action\Get\GetAction;
use App\Domain\News\Action\Upload\UploadAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{

    /**
     * @Route("/api/v1/news/upload", name="api.v1.news.upload", methods={"GET"})
     * @param UploadAction $action
     * @return JsonResponse
     */
    public function uploadAction(UploadAction $action): JsonResponse
    {
        try {

            return new JsonResponse(['result' => 'ok', 'data' => null], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['result' => 'error', 'description' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @Route("/api/v1/news/{id}", requirements={"id"="^(?!upload$).*"}, name="api.v1.news.get", methods={"GET"})
     * @param GetAction $action
     * @param int $id
     * @return JsonResponse
     */
    public function getAction(GetAction $action, int $id): JsonResponse
    {
        try {
            $data = $action->execute($id);

            return new JsonResponse(['result' => 'ok', 'data' => $data], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['result' => 'error', 'description' => $e->getMessage()], $e->getCode());
        }
    }
}