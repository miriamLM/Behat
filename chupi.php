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
    'colorword'  => (new Route('/colorword', ['controller' => EndPointRandomCoolWordWithRandomColor::class]))->setMethods([Request::METHOD_GET])
];

$routeCollection = new RouteCollection();
foreach ($routes as $key => $route) {
    $routeCollection->add($key, $route);
}
$requestContext = new RequestContext();
$matcher = new UrlMatcher($routeCollection, $requestContext);
$request = Request::createFromGlobals();
$requestContext->fromRequest($request);

try {
    $attributes = $matcher->match($requestContext->getPathInfo());
    $ctrlName = $matcher->match($requestContext->getPathInfo())['controller'];
    $ctrl = new $ctrlName();
    $request->attributes->add($attributes);
    $response = $ctrl($request);
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
}

$response->send();
