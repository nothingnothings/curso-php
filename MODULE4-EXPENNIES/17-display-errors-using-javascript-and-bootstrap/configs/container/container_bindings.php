<?php declare(strict_types=1);

use App\Contracts\AuthInterface;
use App\Contracts\RequestServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\SessionInterface;
use App\Contracts\UserProviderServiceInterface;
use App\DTOs\SessionConfig;
use App\Enum\AppEnvironment;
use App\Enum\SameSite;
use App\Factories\ValidatorFactory;
use App\Services\RequestService;
use App\Services\UserProviderService;
use App\Auth;
use App\Config;
use App\Csrf;
use App\Session;
use DI\Container as DIContainer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use GuzzleHttp\Psr7\Request;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\App;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Symfony\WebpackEncoreBundle\Asset\TagRenderer;
use Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension;
use Twig\Extra\Intl\IntlExtension;

use function DI\create;

return [
    // A little bit hacky...
    App::class => function (DIContainer $container) {
        AppFactory::setContainer($container);

        // Import router and middlewares
        $router = require CONFIG_PATH . '/routes/web.php';
        $addMiddlewares = require CONFIG_PATH . '/middleware.php';

        // Create app instance
        $app = AppFactory::create();

        // Register routes and middlewares to app
        $router($app);
        $addMiddlewares($app);

        // Return app itself
        return $app;
    },
    AuthInterface::class => fn(ContainerInterface $container) => $container->get(Auth::class),
    UserProviderServiceInterface::class => fn(ContainerInterface $container) => $container->get(UserProviderService::class),
    SessionInterface::class => fn(Config $config) => new Session(
        new SessionConfig(
            $config->get('session.name', ''),
            $config->get('session.secure', true),
            $config->get('session.httponly', true),
            SameSite::from($config->get('session.samesite', 'lax')),
            $config->get('session.flash_name', 'flash'),
        )
    ),
    RequestValidatorFactoryInterface::class => fn(ContainerInterface $container) => $container->get(ValidatorFactory::class),
    Config::class => create(Config::class)->constructor(require CONFIG_PATH . '/app.php'),
    EntityManager::class => fn(Config $config) => EntityManager::create(
        $config->get('doctrine.connection'),
        ORMSetup::createAttributeMetadataConfiguration(
            $config->get('doctrine.entity_dir'),
            $config->get('doctrine.dev_mode')
        )
    ),
    Twig::class => function (Config $config, ContainerInterface $container) {
        $twig = Twig::create(VIEW_PATH, [
            'cache' => STORAGE_PATH . '/cache/templates',
            'auto_reload' => AppEnvironment::isDevelopment($config->get('app_environment')),
        ]);

        $twig->addExtension(new IntlExtension());
        $twig->addExtension(new EntryFilesTwigExtension($container));
        $twig->addExtension(new AssetExtension($container->get('webpack_encore.packages')));

        return $twig;
    },
    ServerRequestInterface::class => function () {
        return (new \Slim\Psr7\Factory\ServerRequestFactory())->createServerRequest('GET', '/');
    },
    ResponseFactoryInterface::class => fn(App $app) => $app->getResponseFactory(),
    /** The following two bindings are needed for EntryFilesTwigExtension & AssetExtension to work for Twig */
    'webpack_encore.packages' => fn() => new Packages(
        new Package(new JsonManifestVersionStrategy(BUILD_PATH . '/manifest.json'))
    ),
    'webpack_encore.tag_renderer' => fn(ContainerInterface $container) => new TagRenderer(
        new EntrypointLookup(BUILD_PATH . '/entrypoints.json'),
        $container->get('webpack_encore.packages')
    ),
    // CSRF Protection:
    'csrf' => fn(ResponseFactoryInterface $responseFactory, Csrf $csrf) => new \Slim\Csrf\Guard($responseFactory, persistentTokenMode: true, failureHandler: $csrf->failureHandler()),
];
