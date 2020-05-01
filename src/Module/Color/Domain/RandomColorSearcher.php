<?php

namespace LaSalle\ChupiProject\Module\Color\Domain;

use LaSalle\ChupiProject\Module\Color\Domain\Exception\NotFoundCoolWordException;

final class RandomColorSearcher
{
    private $repository;

    public function __construct(ColorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $colors = $this->repository->all();

        if (null === $colors || 0 === count($colors)) {
            throw new NotFoundCoolWordException();
        }

        return $colors[mt_rand(0, count($colors) - 1)];
    }
}
