<?php

use App\Services\Product\FormatterService;
use App\Entity\Category;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ProductFormatterServiceTest extends TestCase
{
    /**
     * @param Request $request
     * @param array $expectedResult
     *
     * @return void
     *
     * @dataProvider createProductFormatRequestDataProvider
     */
    public function testCreateProductFormatRequest(Request $request, array $expectedResult): void
    {
        $this->assertEquals(FormatterService::createProductFormatRequest($request), $expectedResult);
    }

    /**
     * @return array
     */
    public function createProductFormatRequestDataProvider(): array
    {
        $filledUpRequest = new Request();

        $filledUpRequest->query->set('tenant_id', 1);
        $filledUpRequest->query->set('category_id', 1);
        $filledUpRequest->query->set('name', 'Test Name');
        $filledUpRequest->query->set('price', 100);

        return [
            [
                new Request,
                [
                    'tenant_id' => null,
                    'category_id' => null,
                    'name' => null,
                    'price' => null
                ]
            ],
            [
                $filledUpRequest,
                [
                    'tenant_id' => 1,
                    'category_id' => 1,
                    'name' => 'Test Name',
                    'price' => 100
                ]
            ]
        ];
    }

    /**
     * @param Category $category
     * @param array $expectedResult
     *
     * @return void
     *
     * @dataProvider getProductsFormatDataProvider
     */
    public function testGetProductsFormat(Category $category, array $expectedResult): void
    {
        $this->assertEquals(FormatterService::getProductsFormat([$category]), $expectedResult);
    }

    /**
     * @return array
     */
    public function getProductsFormatDataProvider(): array
    {
        $filledUpCategory = new Category();
        $filledUpCategory->setName('Category Name');
        $product = new Product();
        $product->setName('Product Name');
        $filledUpCategory->addProduct($product);

        return [
            [
                new Category(),
                [
                    [
                        'category_id' => null,
                        'category_name' => null,
                        'products' => []
                    ]
                ]
            ],
            [
                $filledUpCategory,
                [
                    [
                        'category_id' => null,
                        'category_name' => 'Category Name',
                        'products' => [
                            [
                                'product_id' => null,
                                'name' => 'Product Name',
                            ]
                        ]
                    ]
                ],
            ]
        ];
    }
}
