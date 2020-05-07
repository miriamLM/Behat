<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Module\Color\Infrastructure;


final class DifferentRandomColorExpectGenerator
{
    public function random_color_except(string $except, callable $randomColorSearcher): string
    {
        $frontColor = $except;

        while ($except === $frontColor) {
            $frontColor = $randomColorSearcher();
        }

        return $frontColor;
    }
}