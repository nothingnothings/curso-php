<?php


declare(strict_types=1);


namespace Tests\Unit;


use App\Exceptions\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;


// assertEquals() --> uses loose comparison (==)
// assertSame() --> uses strict comparison (===)

class RouterTest extends TestCase
{

    private Router $router;

    // This method will always be called before each test (gotten from PHPUnit).
    protected function setUp(): void
    {
        parent::setUp();

        $this->router = new Router();
    }


    /** @test */
    public function it_registers_a_route(): void
    {
        // Given that we have a router object 
        // $router = new Router(); // ? MOVED INTO 'setUp' method.

        // When we call a register method and provide the arguments
        $this->router->register('get', '/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index'],
            ]
        ];

        // Then we assert that the route was registered.
        $this->assertSame($expected, $this->router->routes());
    }

    /** @test */
    public function it_registers_a_get_route(): void
    {
        // Given that we have a router object 
        // $router = new Router(); // ? MOVED INTO 'setUp' method.

        // When we call a get method and provide the arguments
        $this->router->get('/posts', ['Posts', 'index']);

        $expected = [
            'get' => [
                '/posts' => ['Posts', 'index'],
            ]
        ];

        // Then we assert that the route was registered.
        $this->assertSame($expected, $this->router->routes());
    }

    /** @test */
    public function it_registers_a_post_route(): void
    {
        // Given that we have a router object 
        // $router = new Router(); // ? MOVED INTO 'setUp' method.

        // When we call a get method and provide the arguments
        $this->router->post('/posts', ['Posts', 'create']);

        $expected = [
            'post' => [
                '/posts' => ['Posts', 'create'],
            ]
        ];

        // Then we assert that the route was registered.
        $this->assertSame($expected, $this->router->routes());
    }

    /** @test */
    public function it_returns_no_routes_when_router_is_created(): void
    {
        // Given that we have a router class and When we create an instance of it
        $router = new Router();

        $expected = [];

        // Then we assert that the routes are empty.
        $this->assertSame($expected, $this->router->routes());
    }

    /** @test
     *  @dataProvider routeNotFoundCases
     */
    public function it_throws_route_not_found_exception(
        string $requestUri, // Will be provided by the data provider method.
        string $requestMethod
    ): void {
        // Simulate a users class:
        $users = new class () {
            // public function index(): bool
            // {
            //     return true;
            // }

            public function delete(): bool
            {
                return true;
            }
        };



        // Given that we have a router object, and we register these routes
        $this->router->post('/users', [$users::class, 'store']);
        $this->router->get('/users', [$users::class, 'index']);
        $this->router->delete('/users', [$users::class, 'delete']);

        $this->expectException(RouteNotFoundException::class);

        $this->router->resolve($requestUri, $requestMethod);
    }

    public function routeNotFoundCases(): array
    {
        return [
            ['/aRequestUri', 'aRequestMethod'], // request uri doesnt exist, request method doesnt exist, class doesnt exist, method doesnt exist
            ['/users', 'put'], // request uri exists, but request method doesnt exist, class doesnt exist, method doesnt exist
            ['/invoices', 'post'], // request uri doesn't exist, but request method exists, class doesnt exist, method doesnt exist
            ['/users', 'get'], // request uri exists, request method exists, class EXISTS, but method DOESN'T EXIST (index method)
            ['/users', 'post'], // request uri exists, request method exists, class EXISTS, but method DOESN'T EXIST (store method)
            ['/users', 'delete'], // request uri exists, request method exists, class EXISTS, AND METHOD EXISTS (This will result in a test failure, because the exception won't be thrown)
        ];
    }

    /** @test */
    public function it_resolves_route_from_a_closure(): void
    {
        // Given that we have a router object, and we register a route and a closure
        $this->router->get('/users', fn() => [1, 2, 3]);

        // When we resolve the route
        $this->assertSame(
            [1, 2, 3],
            $this->router->resolve('/users', 'get')
        );
    }


    /** @test */
    public function it_resolves_route(): void
    {

        // Simulate a users class:
        $users = new class () {
            public function index(): array
            {
                return [1, 2, 3];
            }
        };


        // Given that we have a router object, and we register a route and a closure
        $this->router->get('/users', [$users::class, 'index']);

        // When we resolve the route
        $this->assertSame(
            [1, 2, 3],
            $this->router->resolve('/users', 'get')
        );
    }

}