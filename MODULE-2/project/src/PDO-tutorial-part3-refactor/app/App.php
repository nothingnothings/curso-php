<?php


declare(strict_types=1);

namespace App30;


class App
{

    protected static \App30\DB $db; // Will be a static property, always available.


    // Initializes the database connection:
    public function __construct(protected \App30\Router $router, protected array $request, protected \App30\Config\Config $config)
    {
        static::$db = new \App30\DB($config->db ?? []);
    }

    // Use the database connection:
    public static function db(): \App30\DB
    {
        return static::$db;
    }

    // Router-related method:
    public function run(): void
    {
        try {
            echo $this->router->resolve(
                $this->request['uri'],
                strtolower($this->request['method'])
            );
        } catch (\App30\Exceptions\RouteNotFoundException $e) {
            http_response_code(404);
            View::make('error/404');
        }
    }


}