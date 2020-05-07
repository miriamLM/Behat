<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Controller\api;


use LaSalle\ChupiProject\Module\Color\Domain\RandomColorSearcher;
use LaSalle\ChupiProject\Module\Color\Infrastructure\InMemoryColorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class EndPointColorController
{
    public function __invoke(Request $request): Response
    {
        $inMemoryColorRepository = new InMemoryColorRepository();
        $randomColorSearcherService= new RandomColorSearcher($inMemoryColorRepository);

        $randomColorSearcher = $randomColorSearcherService();

        return Response::create($randomColorSearcher, 200);
    }
}