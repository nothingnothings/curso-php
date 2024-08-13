<?php


declare(strict_types=1);


namespace Tests\Unit;


use App\Router;
use PHPUnit\Framework\TestCase;


class RouterTest extends TestCase
{

    /** @test */
    public function it_registers_a_route(): void
    {
        // Given that we have a router object 
        $router = new Router();

        // When we call a register method and provide the arguments
        $router->register('get', '/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index'],
            ]
        ];

        // Then we assert that the route was registered.
        $this->assertEquals($expected, $router->routes());
    }

    /** @test */
    public function it_registers_a_get_route(): void
    {
        // Given that we have a router object 
        $router = new Router();

        // When we call a get method and provide the arguments
        $router->get('/posts', ['Posts', 'index']);

        $expected = [
            'get' => [
                '/posts' => ['Posts', 'index'],
            ]
        ];

        // Then we assert that the route was registered.
        $this->assertEquals($expected, $router->routes());
    }

    /** @test */
    public function it_registers_a_post_route(): void
    {
        // Given that we have a router object 
        $router = new Router();

        // When we call a get method and provide the arguments
        $router->post('/posts', ['Posts', 'create']);

        $expected = [
            'post' => [
                '/posts' => ['Posts', 'create'],
            ]
        ];

        // Then we assert that the route was registered.
        $this->assertEquals($expected, $router->routes());
    }

    /** @test */
    public function it_returns_no_routes_when_router_is_created(): void
    {
        // Given that we have a router class and when we create an instance of it
        $router = new Router();

        $expected = [];

        // Then we assert that the routes are empty.
        $this->assertEquals($expected, $router->routes());
    }
}