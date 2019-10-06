<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Tests\Integration;


use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\GenerateBouquets;
use Solaing\FlowerBouquets\Tests\Stubs\InputStub;
use Solaing\FlowerBouquets\Tests\Stubs\OutputStub;

final class TheFlowerBouquetsAreGeneratedInTheOutputTest extends TestCase
{
    private $output;
    private $input;

    public function setUp(): void
    {
        parent::setUp();
        $this->output = new OutputStub();
        $this->input = new InputStub();
    }

    public final function test_the_flower_bouquets_title_is_generated() {
        $filePath = __DIR__ . '/../resources/empty_file.txt';
        $this->input->setStream(fopen($filePath, 'r'));
        (new GenerateBouquets($this->input, $this->output))->exec();

        $writtenLines = $this->output->writtenLines();
        $this->assertEquals('----- Flower Bouquets ---', $writtenLines[1]);
    }

    public final function test_the_bouquet_is_rendered_without_flowers() {
        $filePath = __DIR__ . '/../resources/bouquet_design.txt';
        $this->input->setStream(fopen($filePath, 'r'));
        (new GenerateBouquets($this->input, $this->output))->exec();

        $writtenLines = $this->output->writtenLines();
        $this->assertEquals('AL', $writtenLines[3]);
    }

    public final function test_any_bouquet_is_rendered_with_only_flowers() {
        $filePath = __DIR__ . '/../resources/multiple_flowers.txt';
        $this->input->setStream(fopen($filePath, 'r'));
        (new GenerateBouquets($this->input, $this->output))->exec();

        $writtenLines = $this->output->writtenLines();
        $this->assertEquals(3, sizeof($writtenLines));
    }

    public final function test_multiple_bouquets_are_rendered_with_multiple_designs() {
        $filePath = __DIR__ . '/../resources/multiple_bouquet_designs.txt';
        $this->input->setStream(fopen($filePath, 'r'));
        (new GenerateBouquets($this->input, $this->output))->exec();

        $writtenLines = $this->output->writtenLines();
        $this->assertEquals('AL', $writtenLines[3]);
        $this->assertEquals('AS', $writtenLines[4]);
        $this->assertEquals('BL', $writtenLines[5]);
        $this->assertEquals('BS', $writtenLines[6]);
        $this->assertEquals('CL', $writtenLines[7]);
        $this->assertEquals('DL', $writtenLines[8]);
    }

    public final function test_with_the_sample() {
        $filePath = __DIR__ . '/../resources/sample.txt';
        $this->input->setStream(fopen($filePath, 'r'));
        (new GenerateBouquets($this->input, $this->output))->exec();

        $writtenLines = $this->output->writtenLines();
        $this->assertStringContainsString('ALa10b15c5', $writtenLines[3]);
        $this->assertStringContainsString('ASa10b10c5', $writtenLines[4]);
        $this->assertStringContainsString('BLb15c1c5', $writtenLines[5]);
        $this->assertStringContainsString('BSb10c5c1', $writtenLines[6]);
        $this->assertStringContainsString('CLa20c15c10', $writtenLines[7]);
        $this->assertStringContainsString('DLb20c8', $writtenLines[8]);
    }

    public function tearDown(): void
    {
        unset($this->output);
        parent::tearDown();
    }
}