<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Module\CoolWord\Domain;

use LaSalle\ChupiProject\Module\CoolWord\Domain\Exception\NotFoundCoolWordException;

final class RandomCoolWordSearcher
{
    private CoolWordRepository $repository;

    public function __construct(CoolWordRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): string
    {
        $words = $this->repository->all();

        if (null === $words || 0 === count($words)) {
            throw new NotFoundCoolWordException();
        }

        return $words[mt_rand(0, count($words) - 1)];
    }
}
