<?php declare(strict_types=1);

namespace App;

use App\Contracts\EmailValidationInterface;
use App\Exceptions\RouteNotFoundException;
use App\Models\Email;
use App\Services\AbstractAPI\EmailValidationService;
// use App\Services\Emailable\EmailValidationService;
use App\Services\PaymentGatewayService;
use App\Services\PaymentGatewayServiceInterface;
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Symfony\Component\Mailer\MailerInterface;

class App
{
    // private static DB $db;
    private Config $config;

    public function __construct(
        protected Container $container,
        protected ?Router $router = null,
        protected array $request = [],
    ) {}

    public function boot(): static
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $this->config = new Config($_ENV);

        // static::$db = new DB($this->config->db ?? []); // This will be replaced by the eloquent usage, instead of this usage of DBAL, this wrapper around DBAL.

        $this->initDb($this->config->db ?? []);

        // ! In laravel, the 'set' method is called 'bind'
        // $this->container->set(PaymentGatewayServiceInterface::class, PaymentGatewayService::class);
        // $this->container->set(MailerInterface::class, fn() => new CustomMailer($this->config->mailer['dsn']));

        $this->container->bind(PaymentGatewayServiceInterface::class, PaymentGatewayService::class);
        $this->container->bind(MailerInterface::class, fn() => new CustomMailer($this->config->mailer['dsn']));
        // $this->container->bind(EmailValidationInterface::class, new EmailValidationService($this->config->apiKeys['emailable']));
        $this->container->bind(EmailValidationInterface::class, new EmailValidationService($this->config->apiKeys['abstract']));

        return $this;
    }

    // public static function db(): DB
    // {
    //     return static::$db;
    // }

    public function initDb(array $config): void  // This is the eloquent implementation, replacing  DBAL implementation
    {
        $capsule = new Capsule;

        $capsule->addConnection($config);
        $capsule->setEventDispatcher(new Dispatcher($this->container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        } catch (RouteNotFoundException) {
            http_response_code(404);

            echo View::make('error/404');
        }
    }
}
