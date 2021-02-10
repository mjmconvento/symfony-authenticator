<?php

namespace App\Controller;

use App\Services\Product\ApiService as ProductApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductApiController extends AbstractController
{
    /**
     * @var ProductApiService $productApiService
     */
    private $productApiService;

    /**
     * @param ProductApiService $productApiService
     *
     * @return void
     */
    public function __construct(ProductApiService $productApiService)
    {
        $this->productApiService = $productApiService;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getProducts(Request $request): JsonResponse
    {
        return $this->json(
            $this->productApiService->getProducts($request->get('tenant'))
        );
    }
}
