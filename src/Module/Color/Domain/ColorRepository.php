<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Module\Color\Domain;

interface  ColorRepository
{
    public function all(): array;
}
