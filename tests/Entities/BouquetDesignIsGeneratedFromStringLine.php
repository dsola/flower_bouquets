<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Entities;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\BouquetDesign;

final class BouquetDesignIsGeneratedFromStringLine extends TestCase
{
    public final function test_bouquet_design_contains_the_correct_name()
    {
        $bouquetDesign = BouquetDesign::fromLine("AS3a4b6k20");

        $this->assertEquals("A", $bouquetDesign->name());
    }

    public final function test_bouquet_design_contains_the_correct_flower_size()
    {
        $bouquetDesign = BouquetDesign::fromLine("AS3a4b6k20");

        $this->assertEquals("S", $bouquetDesign->flowerSize());
    }

    public final function test_bouquet_design_contains_the_correct_total()
    {
        $bouquetDesign = BouquetDesign::fromLine("AS3a4b6k345667");

        $this->assertEquals(345667, $bouquetDesign->totalFlowers());
    }
}