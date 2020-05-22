<?php

declare(strict_types=1);

namespace LaSalle\ChupiTest\Infrastructure\Controller;


use Colors\Color;
use LaSalle\ChupiProject\Module\Color\Domain\RandomColorSearcher;
use LaSalle\ChupiProject\Module\Color\Infrastructure\DifferentRandomColorExpectGenerator;
use LaSalle\ChupiProject\Module\Color\Infrastructure\InMemoryColorRepository;
use LaSalle\ChupiProject\Module\CoolWord\Domain\RandomCoolWordSearcher;
use LaSalle\ChupiProject\Module\CoolWord\Infrastructure\InMemoryCoolWordRepository;
use LaSalle\ChupiTest\Infrastructure\InMemoryColorStub;
use LaSalle\ChupiTest\Infrastructure\InMemoryCoolWordStub;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class EndPointRandomCoolWordWithRandomColorTest
{
    public function __invoke(Request $request): Response
    {
        $wordSearcher  = new RandomCoolWordSearcher(new InMemoryCoolWordStub());

        $coolword = $wordSearcher();

        $colorSearcher = new RandomColorSearcher(new InMemoryColorStub());

        $bgColor = $colorSearcher();

        $differentColorGenerator= new DifferentRandomColorExpectGenerator();
        $fgColor = $differentColorGenerator->random_color_except($bgColor, $colorSearcher);

        $color = new Color();
        $coolwordwithstyle=$color($coolword)->bg($bgColor)->$fgColor . PHP_EOL;

        $myArr = array("background color"=>$bgColor, "font color"=>$fgColor, "cool word"=>$coolword);
        $myJSON = json_encode($myArr);

        return Response::create($myJSON, 200);
    }
}