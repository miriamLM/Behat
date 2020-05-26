<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Module\Color\Domain;

use LaSalle\ChupiProject\Module\Color\Domain\Exception\NotEnoughColorException;

final class RandomColorSearcher
{
    private ColorRepository $repository;

    public function __construct(ColorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke():string
    {
        $colors = $this->repository->all();

        if (null === $colors || 2 > count($colors)) {
            throw new NotEnoughColorException();
        }

        return $colors[mt_rand(0, count($colors) - 1)];
    }
}
