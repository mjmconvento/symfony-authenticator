<?php

namespace App\Services\Product;

use App\Entity\Category;
use App\Entity\Tenant;
use App\Services\ChangeDbService;
use App\Services\Product\FormatterService;
use Doctrine\ORM\EntityManagerInterface;

class ApiService
{
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
    public function getProducts(string $tenantDbName): array
    {
        $tenant = $this->entityManager->getRepository(Tenant::class)->findOneBy([
            'tenant_name' => $tenantDbName
        ]);

        $this->changeDbService->changeDb($tenant->getTenantDb());
        $categories = $this->entityManager->getRepository(Category::class)->findAll();

        return FormatterService::getProductsFormat($categories);
    }
}
