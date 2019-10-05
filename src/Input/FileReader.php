<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Input;


use Solaing\FlowerBouquets\Entities\Container;

final class FileReader
{
    public function read(string $filePath): Container
    {
        $fn = fopen($filePath, "r");

        while (!feof($fn)) {
            $result = fgets($fn);
            if (!empty($result)) {

            }
        }

        fclose($fn);

        return new Container();
    }
}