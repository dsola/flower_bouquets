<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Exceptions;


final class InvalidSize extends \InvalidArgumentException
{
    public static function fromSize(string $size): self
    {
        return new self("The flower/bouquet $size is invalid");
    }
}