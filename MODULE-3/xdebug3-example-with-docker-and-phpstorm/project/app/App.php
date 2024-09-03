<?php declare(strict_types=1);

namespace App;

use App\Contracts\EmailValidationInterface;
use App\Exceptions\RouteNotFoundException;
use App\Services\AbstractAPI\EmailValidationService;
use App\Services\PaymentGatewayService;
use App\Services\PaymentGatewayServiceInterface;
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Extra\Intl\IntlExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

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

        $this->initDb($this->config->db ?? []);

        // Initialize twig templating engine:
        $loader = new FilesystemLoader(VIEW_PATH);
        $twig = new Environment($loader, [
            'cache' => STORAGE_PATH . '/cache',
            'auto_reload' => true,
        ]);

        $twig->addExtension(new IntlExtension());

        $this->container->bind(PaymentGatewayServiceInterface::class, PaymentGatewayService::class);
        $this->container->bind(MailerInterface::class, fn() => new CustomMailer($this->config->mailer['dsn']));
        $this->container->bind(EmailValidationInterface::class, fn() => new EmailValidationService($this->config->apiKeys['abstract']));

        // Twig must be available in our controllers.
        $this->container->singleton(Environment::class, fn() => $twig);

        return $this;
    }

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
