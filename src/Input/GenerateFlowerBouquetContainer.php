<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Input;


use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;

final class GenerateFlowerBouquetContainer
{
    public function fromFilePath(string $filePath): FlowerBouquetContainer
    {
        $fn = fopen($filePath, "r");

        while (!feof($fn)) {
            $result = fgets($fn);
            if (!empty($result)) {

            }
        }

        fclose($fn);

        return new FlowerBouquetContainer();
    }
}