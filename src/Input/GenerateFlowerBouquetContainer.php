<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Input;


use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;

final class GenerateFlowerBouquetContainer
{
    public function fromFilePath(string $filePath): FlowerBouquetContainer
    {
        $fn = fopen($filePath, "r");
        $container = new FlowerBouquetContainer();

        while (!feof($fn)) {
            $stringLine = fgets($fn);
            if ($this->isEmptyLine($stringLine)) {
                continue;
            }
            if ($this->isFormatttedForFlower($stringLine)) {
                $container->addFlower(Flower::fromLine($stringLine));
                continue;
            }
        }

        fclose($fn);

        return new FlowerBouquetContainer();
    }

    public function isEmptyLine(string $result): bool
    {
        return !empty($result);
    }

    public function isFormatttedForFlower($result): bool
    {
        return !empty($result);
    }
}