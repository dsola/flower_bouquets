<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Input;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Input\GenerateFlowerBouquetContainer;

final class FlowerBouquetContainerIsBeingGeneratedFromFileTest extends TestCase
{
    private const RESOURCES_DIR_PATH = __DIR__ . '/../../resources';

    public final function test_container_is_not_filled_when_there_is_an_empty_line() {
        $generator = new GenerateFlowerBouquetContainer();

        $container = $generator->fromFilePath(self::RESOURCES_DIR_PATH.'/empty_file.txt');

        $this->assertEmpty($container->flowers());
        $this->assertEmpty($container->bouquetDesigns());
    }

    public final function test_container_is_filled_with_a_flower() {
        $generator = new GenerateFlowerBouquetContainer();

        $container = $generator->fromFilePath(self::RESOURCES_DIR_PATH.'/one_flower.txt');

        $this->assertEquals(1, sizeof($container->flowers()));
    }

    public final function test_container_is_filled_with_a_multiple_flowers() {
        $generator = new GenerateFlowerBouquetContainer();

        $container = $generator->fromFilePath(self::RESOURCES_DIR_PATH.'/multiple_flowers.txt');

        $this->assertEquals(5, sizeof($container->flowers()));
    }

    public final function test_container_is_filled_with_a_the_wrong_flowers() {
        $generator = new GenerateFlowerBouquetContainer();

        $container = $generator->fromFilePath(self::RESOURCES_DIR_PATH.'/wrong_flowers.txt');

        $this->assertEquals(3, sizeof($container->flowers()));
    }

    public final function test_container_is_filled_with_a_bouquet_design() {
        $generator = new GenerateFlowerBouquetContainer();

        $container = $generator->fromFilePath(self::RESOURCES_DIR_PATH.'/bouquet_design.txt');

        $this->assertEquals(1, sizeof($container->bouquetDesigns()));
    }

    public final function test_container_is_filled_with_multiple_bouquet_designs() {
        $generator = new GenerateFlowerBouquetContainer();

        $container = $generator->fromFilePath(self::RESOURCES_DIR_PATH.'/multiple_bouquet_designs.txt');

        $this->assertEquals(6, sizeof($container->bouquetDesigns()));
    }

}