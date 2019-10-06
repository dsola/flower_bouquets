<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Exceptions\InvalidBouquetSize;
use Solaing\FlowerBouquets\Exceptions\InvalidFlowerSpecie;

final class FlowerIsGeneratedFromStringLineTest extends TestCase
{
    final public function test_flower_is_generated_with_the_proper_format() {

        $flower = Flower::fromLine("aL");

        $this->assertEquals("a", $flower->specie());
        $this->assertEquals("L", $flower->bouquetSize());
        $this->assertEquals(1, $flower->quantity());
    }

    final public function test_flower_is_not_generated_with_the_wrong_size() {
        $this->expectException(InvalidBouquetSize::class);

        Flower::fromLine("aK");
    }

    final public function test_flower_is_not_generated_with_the_wrong_specie() {
        $this->expectException(InvalidFlowerSpecie::class);

        Flower::fromLine("WL");
    }
}