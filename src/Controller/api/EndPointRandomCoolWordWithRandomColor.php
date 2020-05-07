<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Controller\api;

use Colors\Color;
use LaSalle\ChupiProject\Module\Color\Domain\RandomColorSearcher;
use LaSalle\ChupiProject\Module\Color\Infrastructure\DifferentRandomColorExpectGenerator;
use LaSalle\ChupiProject\Module\Color\Infrastructure\InMemoryColorRepository;
use LaSalle\ChupiProject\Module\CoolWord\Domain\RandomCoolWordSearcher;
use LaSalle\ChupiProject\Module\CoolWord\Infrastructure\InMemoryCoolWordRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class EndPointRandomCoolWordWithRandomColor
{
    public function __invoke(Request $request): Response
    {
        $wordSearcher  = new RandomCoolWordSearcher(new InMemoryCoolWordRepository());
        $colorSearcher = new RandomColorSearcher(new InMemoryColorRepository());

        $bgColor = $colorSearcher();

        $differentColorGenerator= new DifferentRandomColorExpectGenerator();
        $fgColor = $differentColorGenerator->random_color_except($bgColor, $colorSearcher);

        $color = new Color();
        $coolwordwithstyle=$color($wordSearcher())->bg($bgColor)->$fgColor . PHP_EOL;


        return Response::create($coolwordwithstyle, 200);
    }

}