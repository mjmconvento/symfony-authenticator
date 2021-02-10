<?php

namespace App\Controller;

use App\Services\Product\Service as ProductService;
use App\Services\Product\FormatterService as ProductFormatterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends AbstractController
{
    /**
     * @var ProductService $productService
     */
    private $productService;

    /**
     * @param ProductService $productService
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return Response
     */
    public function createProductPage(): Response
    {
        return $this->render('createProduct.html.twig', $this->productService->getCreateProductPageParameters());
    }

    /**
     * @param Request $request
     *
     * @return object
     */
    public function createProductSave(Request $request): object
    {
        try {
            $this->productService->saveProduct(ProductFormatterService::createProductFormatRequest($request));
            $this->addFlash('success', 'Your changes were saved');
            return $this->redirectToRoute('secured_page');
        } catch(\Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('create_product_page');
        }
    }
}
