<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Exceptions;


use InvalidArgumentException;

final class InvalidFlowerSpecie extends InvalidArgumentException
{
    public static function fromCharacter(string $specie): self
    {
        return new self("The flower specie '$specie'' is invalid");
    }
}