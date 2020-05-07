<?php require 'vendor/autoload.php';

use Colors\Color;
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
    $return = $except;

    while ($except === $return) {
        $return = $randomColorSearcher();
    }

    return $return;
}
