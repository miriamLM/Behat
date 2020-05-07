<?php require 'vendor/autoload.php';

use Colors\Color;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use LaSalle\ChupiProject\Controller\api\EndPointRandomColor;
use LaSalle\ChupiProject\Module\Color\Domain\RandomColorSearcher;
use LaSalle\ChupiProject\Module\Color\Infrastructure\InMemoryColorRepository;
use LaSalle\ChupiProject\Module\CoolWord\Domain\RandomCoolWordSearcher;
use LaSalle\ChupiProject\Module\CoolWord\Infrastructure\InMemoryCoolWordRepository;

$wordSearcher  = new RandomCoolWordSearcher(new InMemoryCoolWordRepository());
$colorSearcher = new RandomColorSearcher(new InMemoryColorRepository());

$bgColor = $colorSearcher();
$fgColor = _random_color_except($bgColor, $colorSearcher);

$color = new Color();
echo $color($wordSearcher())->bg($bgColor)->$fgColor . PHP_EOL;

function _random_color_except(string $except, callable $randomColorSearcher): string
{
    $frontColor = $except;

    while ($except === $frontColor) {
        $frontColor = $randomColorSearcher();
    }

    return $frontColor;
}


$routes = [
    'color'   => (new Route('/color',           ['controller' => EndPointRandomColor::class]))->setMethods([Request::METHOD_GET]),
    'word'  => (new Route('/word', ['controller' => UserController::class]))->setMethods([Request::METHOD_GET])
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
