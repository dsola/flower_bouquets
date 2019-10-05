<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Input;


use Solaing\FlowerBouquets\Entities\BouquetDesign;
use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;

final class GenerateFlowerBouquetContainer
{
    public function fromFilePath(string $filePath): FlowerBouquetContainer
    {
        $fn = fopen($filePath, "r");
        $container = new FlowerBouquetContainer();

        while (!feof($fn)) {
            $stringLine = trim((string)fgetss($fn));
            if ($this->isEmptyLine($stringLine)) {
                continue;
            }
            if ($this->isFormattedForFlower($stringLine)) {
                $container->addFlower(Flower::fromLine($stringLine));
                continue;
            }
            if ($this->isFormattedForBouquetDesign($stringLine)) {
                $container->addBouquetDesign(BouquetDesign::fromLine($stringLine));
            }
        }

        fclose($fn);

        return $container;
    }

    private function isEmptyLine(string $line): bool
    {
        return empty($line);
    }

    private function isFormattedForFlower(string $line): bool
    {
        return (bool)preg_match('/^[a-z](S|L)$/', $line);
    }

    private function isFormattedForBouquetDesign(string $line): bool
    {
        return (bool)preg_match('/^[A-Z](S|L)(.*)([0-9]+)$/', $line);
    }
}