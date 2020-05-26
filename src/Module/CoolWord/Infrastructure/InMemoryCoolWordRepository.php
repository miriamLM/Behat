<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Module\CoolWord\Infrastructure;

use LaSalle\ChupiProject\Module\CoolWord\Domain\CoolWordRepository;

final class InMemoryCoolWordRepository implements CoolWordRepository
{
    public function all(): array
    {
        return [
            'Chachi pistachi!',
            'Esto mola mogollón, tío!',
            'Mola mazo!',
            'Eres mazo guay',
            'Holiiiiii',
            'Besiis',
        ];
    }
}
