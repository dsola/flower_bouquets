<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Input;


use Solaing\FlowerBouquets\Entities\BouquetDesign;
use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;

final class GenerateFlowerBouquetContainer
{
    private function __construct()
    {
    }

    public static function fromResource($streamResource): FlowerBouquetContainer
    {
        $container = new FlowerBouquetContainer();

        while (!feof($streamResource)) {
            $stringLine = trim((string)fgetss($streamResource));
            if (self::isEmptyLine($stringLine)) {
                continue;
            }
            if (self::isFormattedForFlower($stringLine)) {
                $container->addFlower(Flower::fromLine($stringLine));
                continue;
            }
            if (self::isFormattedForBouquetDesign($stringLine)) {
                $container->addBouquetDesign(BouquetDesign::fromLine($stringLine));
            }
        }

        fclose($streamResource);

        return $container;
    }

    private static function isEmptyLine(string $line): bool
    {
        return empty($line);
    }

    private static function isFormattedForFlower(string $line): bool
    {
        return (bool)preg_match('/^[a-z](S|L)$/', $line);
    }

    private static function isFormattedForBouquetDesign(string $line): bool
    {
        return (bool)preg_match('/^[A-Z](S|L)(.*)([0-9]+)$/', $line);
    }
}