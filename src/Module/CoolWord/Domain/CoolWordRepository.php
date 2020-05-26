<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Module\CoolWord\Domain;

interface CoolWordRepository
{
    public function all(): array;
}
