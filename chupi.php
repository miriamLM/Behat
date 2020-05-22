<?php require 'vendor/autoload.php';

use LaSalle\ChupiProject\Controller\api\EndPointRandomCoolWord;
use LaSalle\ChupiProject\Controller\api\EndPointRandomCoolWordWithRandomColor;
use LaSalle\ChupiTest\Infrastructure\Controller\EndPointRandomColorTest;
use LaSalle\ChupiTest\Infrastructure\Controller\EndPointRandomCoolWordTest;
use LaSalle\ChupiTest\Infrastructure\Controller\EndPointRandomCoolWordWithRandomColorTest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use LaSalle\ChupiProject\Controller\api\EndPointRandomColor;


$routes = [
    'color'   => (new Route('/color',           ['controller' => EndPointRandomColor::class]))->setMethods([Request::METHOD_GET]),
    'coolword'  => (new Route('/coolword', ['controller' => EndPointRandomCoolWord::class]))->setMethods([Request::METHOD_GET]),
    'colorword'  => (new Route('/colorword', ['controller' => EndPointRandomCoolWordWithRandomColor::class]))->setMethods([Request::METHOD_GET]),
    'colortest'   => (new Route('/colortest',           ['controller' => EndPointRandomColorTest::class]))->setMethods([Request::METHOD_GET]),
    'coolwordtest'  => (new Route('/coolwordtest', ['controller' => EndPointRandomCoolWordTest::class]))->setMethods([Request::METHOD_GET]),
    'colorwordtest'  => (new Route('/colorwordtest', ['controller' => EndPointRandomCoolWordWithRandomColorTest::class]))->setMethods([Request::METHOD_GET])
];

$rc = new RouteCollection();
foreach ($routes as $key => $route) {
    $rc->add($key, $route);
}
$context = new RequestContext();
$matcher = new UrlMatcher($rc, $context);
$request = Request::createFromGlobals();
$context->fromRequest($request);

try {
    $attributes = $matcher->match($context->getPathInfo());
    $ctrlName = $matcher->match($context->getPathInfo())['controller'];
    $ctrl = new $ctrlName();
    $request->attributes->add($attributes);
    $response = $ctrl($request);
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
}

$response->send();
