<?php

namespace App\Services\Product;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Tenant;
use App\Services\ChangeDbService;
use Doctrine\ORM\EntityManagerInterface;

class Service
{
    /**
     * @var string DEFAULT_DB_NAME
     */
    private const DEFAULT_DB_NAME = 'tenant_one';

    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var ChangeDbService $changeDbService
     */
    private $changeDbService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ChangeDbService $changeDbService
     *
     * @return void
     */
    public function __construct(EntityManagerInterface $entityManager, ChangeDbService $changeDbService)
    {
        $this->entityManager = $entityManager;
        $this->changeDbService = $changeDbService;
    }

    /**
     * @param string $tenantDbName
     *
     * @return array
     */
    public function getCreateProductPageParameters(): array
    {
        $tenants = $this->entityManager->getRepository(Tenant::class)->findAll();
        $this->changeDbService->changeDb(self::DEFAULT_DB_NAME);

        return [
            'tenants' => $tenants,
            'categories' => $this->entityManager->getRepository(Category::class)->findAll()
        ];
    }

    /**
     * @param array $parameters
     *
     * @return void
     */
    public function saveProduct(array $parameters): void
    {
        $tenant = $this->entityManager->getRepository(Tenant::class)
            ->find($parameters['tenant_id']);
        
        $this->changeDbService->changeDb($tenant->getTenantDb());
        
        $category = $this->entityManager->getRepository(Category::class)
            ->find($parameters['category_id']);

        $product = new Product();
        $product->setName($parameters['name']);
        $product->setPrice((float) $parameters['price']);
        $product->setCategory($category);

        $this->entityManager->merge($product);
        $this->entityManager->flush();
    }
}
