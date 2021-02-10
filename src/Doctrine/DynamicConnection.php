<?php

namespace App\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver;

class DynamicConnection extends Connection
{
    /**
     * @var string $dbEngine
     */
    private $dbEngine;

    /**
     * @var string $host
     */
    private $host;
    
    /**
     * @var string $port
     */    
    private $port;

    /**
     * @var string $user
     */
    private $user;
    
    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $dbName
     */
    private $dbName;

    /**
     * @param string $dbEngine
     *
     * @return void
     */
    public function setDbEngine(string $dbEngine)
    {
        $this->dbEngine = $dbEngine;
    }

    /**
     * @param string $dbName
     *
     * @return void
     */
    public function setDbname(string $dbName)
    {
        $this->dbName = $dbName;
    }

    /**
     * @param string $host
     *
     * @return void
     */
    public function setHost(string $host)
    {
        $this->host = $host;
    }
    
    /**
     * @param string $port
     *
     * @return void
     */
    public function setPort(string $port)
    {
        $this->port = $port;
    }

    /**
     * @param string $user
     *
     * @return void
     */
    public function setUser(string $user)
    {
        $this->user = $user;
    }

    /**
     * @param string $password
     *
     * @return void
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return void
     */
    public function changeDatabase()
    {
        $params = $this->getParams();

        if ($this->isConnected()) {
            $this->close();
        }

        $params['url'] = sprintf('%s://%s:%s@%s:%s/%s', $this->dbEngine, $this->user,
            $this->password, $this->host, $this->port, $this->dbName);

        $params['host'] = $this->host;
        $params['port'] = $this->port;
        $params['dbname'] = $this->dbName;
        $params['user'] = $this->user;
        $params['password'] = $this->password;
        
        parent::__construct(
            $params,
            $this->_driver,
            $this->_config,
            $this->_eventManager
        );
    }
}
