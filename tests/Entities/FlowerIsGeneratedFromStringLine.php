<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Entities;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Exceptions\InvalidFlowerSize;
use Solaing\FlowerBouquets\Exceptions\InvalidFlowerSpecie;

final class FlowerIsGeneratedFromStringLine extends TestCase
{
    final public function test_flower_is_generated_with_the_proper_format() {

        $flower = Flower::fromLine("aL");

        $this->assertEquals("a", $flower->specie());
        $this->assertEquals("L", $flower->size());
        $this->assertEquals(1, $flower->quantity());
    }

    final public function test_flower_is_not_generated_with_the_wrong_size() {
        $this->expectException(InvalidFlowerSize::class);

        Flower::fromLine("aK");
    }

    final public function test_flower_is_not_generated_with_the_wrong_specie() {
        $this->expectException(InvalidFlowerSpecie::class);

        Flower::fromLine("WL");
    }
}