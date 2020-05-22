<?php

declare(strict_types=1);

namespace LaSalle\ChupiTest\Infrastructure\Controller;


use LaSalle\ChupiProject\Module\CoolWord\Domain\RandomCoolWordSearcher;
use LaSalle\ChupiTest\Infrastructure\InMemoryCoolWordStub;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class EndPointRandomCoolWordTest
{
    public function __invoke(Request $request): Response
    {
        $inMemoryCoolWordRepository = new InMemoryCoolWordStub();
        $randomCoolWordSearcherService= new RandomCoolWordSearcher($inMemoryCoolWordRepository);

        $randomCoolWordSearcher = $randomCoolWordSearcherService();

        return Response::create($randomCoolWordSearcher, 200);
    }
}