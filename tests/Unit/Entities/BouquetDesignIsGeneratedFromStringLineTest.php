<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\BouquetDesign;
use Solaing\FlowerBouquets\Entities\Flower;

final class BouquetDesignIsGeneratedFromStringLineTest extends TestCase
{
    public final function test_bouquet_design_contains_the_correct_name()
    {
        $bouquetDesign = BouquetDesign::fromLine("AS3a4b6k20");

        $this->assertEquals("A", $bouquetDesign->name());
    }

    public final function test_bouquet_design_contains_the_correct_flower_size()
    {
        $bouquetDesign = BouquetDesign::fromLine("AS3a4b6k20");

        $this->assertEquals("S", $bouquetDesign->bouquetSize());
    }

    public final function test_bouquet_design_contains_the_correct_total()
    {
        $bouquetDesign = BouquetDesign::fromLine("AS3a4b6k345667");

        $this->assertEquals(345667, $bouquetDesign->totalFlowers());
    }

    public final function test_bouquet_design_contains_the_correct_flower()
    {
        $bouquetDesign = BouquetDesign::fromLine("AS3a20");

        /** @var Flower $flower */
        $flower = $bouquetDesign->flowers()[0];
        $this->assertEquals("a", $flower->specie());
        $this->assertEquals("S", $flower->bouquetSize());
        $this->assertEquals(3, $flower->quantity());
    }

    public final function test_bouquet_design_contains_the_correct_number_of_flowers()
    {
        $bouquetDesign = BouquetDesign::fromLine("AS3a4b6k20");

        $flowers = $bouquetDesign->flowers();
        /** @var Flower $flower */
        $flower = $flowers[0];
        $this->assertEquals("a", $flower->specie());
        $this->assertEquals("S", $flower->bouquetSize());
        $this->assertEquals(3, $flower->quantity());
        $flower = $flowers[1];
        $this->assertEquals("b", $flower->specie());
        $this->assertEquals("S", $flower->bouquetSize());
        $this->assertEquals(4, $flower->quantity());
        $flower = $flowers[2];
        $this->assertEquals("k", $flower->specie());
        $this->assertEquals("S", $flower->bouquetSize());
        $this->assertEquals(6, $flower->quantity());
    }

    public final function test_bouquet_design_contains_flowers_with_more_than_one_digit_in_the_quantity()
    {
        $bouquetDesign = BouquetDesign::fromLine("AS30a44b6k20");

        $flowers = $bouquetDesign->flowers();
        /** @var Flower $flower */
        $flower = $flowers[0];
        $this->assertEquals(30, $flower->quantity());
        $flower = $flowers[1];
        $this->assertEquals(44, $flower->quantity());

    }

}