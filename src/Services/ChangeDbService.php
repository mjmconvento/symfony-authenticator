<?php

namespace App\Services;

use Doctrine\DBAL\Connection;

class ChangeDbService
{
    /**
     * @var Connection $dbalConnection
     */ 
    private $dbalConnection;

    /**
     * @param Connection $dbalConnection
     *
     * @return void
     */ 
    public function __construct(Connection $dbalConnection)
    {
        $this->dbalConnection = $dbalConnection;
    }

    /**
     * @param string $newDbName
     *
     * @return void
     */ 
    public function changeDb(string $newDbName): void
    {
        $this->dbalConnection->setDbEngine($_ENV['DEFAULT_DB_ENGINE']);
        $this->dbalConnection->setHost($_ENV['DEFAULT_DB_HOST']);
        $this->dbalConnection->setPort($_ENV['DEFAULT_DB_PORT']);
        $this->dbalConnection->setUser($_ENV['DEFAULT_DB_USER']);
        $this->dbalConnection->setPassword($_ENV['DEFAULT_DB_PASSWORD']);
        $this->dbalConnection->setDbName($newDbName);
        $this->dbalConnection->changeDatabase();
    }
}
