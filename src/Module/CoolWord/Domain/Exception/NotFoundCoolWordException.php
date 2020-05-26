<?php

declare(strict_types=1);

namespace LaSalle\ChupiProject\Module\CoolWord\Domain\Exception;

use DomainException;

final class NotFoundCoolWordException extends DomainException
{
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    public function errorMessage():string
    {
        return "Not found cool word";
    }
}