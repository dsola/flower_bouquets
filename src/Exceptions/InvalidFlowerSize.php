<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Exceptions;


final class InvalidFlowerSize extends \InvalidArgumentException
{
    public static function fromCharacter(string $size): self
    {
        return new self("The flower size '$size'' is invalid");
    }
}