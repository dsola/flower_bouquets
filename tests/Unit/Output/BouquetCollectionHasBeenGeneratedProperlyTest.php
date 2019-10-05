<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Output;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;
use Solaing\FlowerBouquets\Output\GenerateBouquetCollection;

final class BouquetCollectionHasBeenGeneratedProperlyTest extends TestCase
{
    public final function test_bouquet_collection_is_empty_when_the_container_does_not_have_bouquet_designs() {
        $container = new FlowerBouquetContainer();

        $collection = (new GenerateBouquetCollection())->fromContainer($container);

        $this->assertEmpty($collection);
    }
}