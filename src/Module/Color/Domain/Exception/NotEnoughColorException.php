<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Module\Color\Domain\Exception;

use DomainException;

final class NotEnoughColorException extends DomainException
{
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    public function errorMessage():string
    {
        return "Not enough colors.";
    }
}