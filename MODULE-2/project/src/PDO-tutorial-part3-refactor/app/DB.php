<?php



declare(strict_types=1);

namespace App30;

class DB
{
    private \PDO $pdo;

    public function __construct(\App30\Config\Config $config, array $defaultOptions = [])
    {
        $defaultOptions = [
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new \PDO(
                $config['driver'] . 'host=' . $config['db_host'] . ';dbname=' . $config['database'], // This is how you use env variables (if you load them with phpdotenv)
                $config['db_user'], // username
                $config['db_password'], // password
                $config['options'] ?? $defaultOptions // options
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    // This is crucial.
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }
}