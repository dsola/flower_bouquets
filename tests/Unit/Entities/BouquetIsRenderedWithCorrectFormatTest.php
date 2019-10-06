<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Tests\Factories\BouquetFactory;
use Solaing\FlowerBouquets\Tests\Factories\FlowerFactory;

final class BouquetIsRenderedWithCorrectFormatTest extends TestCase
{
    final public function test_when_bouquet_has_no_flowers() {
        $bouquet = BouquetFactory::buildWithNameAndSize('A', 'S');

        $output = $bouquet->render();

        $this->assertEquals('AS', $output);
    }

    final public function test_when_bouquet_has_some_flowers() {
        $flowers = [
            FlowerFactory::make('a', 'S', 5),
            FlowerFactory::make('b', 'S', 7),
            FlowerFactory::make('c', 'S', 9),
        ];
        $bouquet = BouquetFactory::build('A', 'S', $flowers, 30);

        $output = $bouquet->render();

        $this->assertEquals('ASa5b7c9', $output);
    }
}