<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Exceptions;


final class InvalidBouquetSize extends \InvalidArgumentException
{
    public static function fromCharacter(string $size): self
    {
        return new self("The bouquet size '$size'' is invalid");
    }
}