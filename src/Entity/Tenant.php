<?php

namespace App\Entity;

use App\Repository\TenantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TenantRepository::class)
 * @ORM\Table(name="`tenants`")
 */
class Tenant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $tenant_name;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $tenant_db;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTenantName(): ?string
    {
        return $this->tenant_name;
    }

    /**
     * @param string $tenantName
     *
     * @return self
     */
    public function setTenantName(string $tenantName): self
    {
        $this->tenant_name = $tenantName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTenantDb(): ?string
    {
        return $this->tenant_db;
    }

    /**
     * @param string $tenantDb
     *
     * @return self
     */
    public function setTenantDb(string $tenantDb): self
    {
        $this->tenant_db = $tenantDb;

        return $this;
    }
}
