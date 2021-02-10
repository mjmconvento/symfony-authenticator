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
        $this->dbalConnection->changeDatabase(
            $_ENV['DEFAULT_DB_HOST'],
            $_ENV['DEFAULT_DB_PORT'],
            $_ENV['DEFAULT_DB_USERNAME'],
            $_ENV['DEFAULT_DB_PASSWORD'],
            $newDbName
        );
    }
}
