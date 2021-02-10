<?php

namespace App\Services\Product;

use Symfony\Component\HttpFoundation\Request;

class FormatterService
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public static function createProductFormatRequest(Request $request): array
    {
        return [
            'tenant_id' => $request->get('tenant_id'),
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'price' => $request->get('price')
        ];
    }

    /**
     * @param array $categories
     *
     * @return array
     */
    public static function getProductsFormat(array $categories): array
    {
        $categoryCollection = [];

        foreach ($categories as $category) {
            $productCollection = [];
            foreach ($category->getProducts() as $product) {
                $productCollection[] = [
                    'product_id' => $product->getId(),
                    'name' => $product->getName()
                ];
            }

            $categoryCollection[] = [
                'category_id' => $category->getId(),
                'category_name' => $category->getName(),
                'products' => $productCollection,
            ];
        }

        return $categoryCollection;
    }

}
