<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Controller\api;


use LaSalle\ChupiProject\Module\Color\Domain\RandomColorSearcher;
use LaSalle\ChupiProject\Module\Color\Infrastructure\InMemoryColorRepository;
use LaSalle\ChupiProject\Module\CoolWord\Domain\RandomCoolWordSearcher;
use LaSalle\ChupiProject\Module\CoolWord\Infrastructure\InMemoryCoolWordRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class EndPointRandomCoolWord
{
    public function __invoke(Request $request): Response
    {
        $inMemoryCoolWordRepository = new InMemoryCoolWordRepository();
        $randomCoolWordSearcherService= new RandomCoolWordSearcher($inMemoryCoolWordRepository);

        $randomCoolWordSearcher = $randomCoolWordSearcherService();

        return Response::create($randomCoolWordSearcher, 200);
    }
}