<?php

declare(strict_types=1);

namespace LaSalle\ChupiTest\Infrastructure\Controller;


use LaSalle\ChupiProject\Module\Color\Domain\RandomColorSearcher;
use LaSalle\ChupiTest\Infrastructure\InMemoryColorStub;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class EndPointRandomColorTest
{
    public function __invoke(Request $request): Response
    {
        $inMemoryColorRepository = new InMemoryColorStub();
        $randomColorSearcherService= new RandomColorSearcher($inMemoryColorRepository);

        $randomColorSearcher = $randomColorSearcherService();

        return Response::create($randomColorSearcher, 200);
    }
}