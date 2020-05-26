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

        $coolword = $wordSearcher();

        $colorSearcher = new RandomColorSearcher(new InMemoryColorRepository());

        $backgroundColor = $colorSearcher();

        $differentColorGenerator= new DifferentRandomColorExpectGenerator();
        $fontColor = $differentColorGenerator->random_color_except($backgroundColor, $colorSearcher);

        $color = new Color();
        $coolwordwithstyle=$color($coolword)->bg($backgroundColor)->$fontColor . PHP_EOL;

        $coolwordWithStyleArray = array("background color"=>$backgroundColor, "font color"=>$fontColor, "cool word"=>$coolword);
        $coolwordWithStyleJSON = json_encode($coolwordWithStyleArray);

        return Response::create($coolwordWithStyleJSON, 200);
    }

}