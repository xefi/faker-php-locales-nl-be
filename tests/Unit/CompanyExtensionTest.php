<?php

namespace Xefi\Faker\NlBe\Tests\Unit;

use Random\Randomizer;
use Xefi\Faker\NlBe\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new \ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing(
            $this->companies,
            $results
        );
    }

    public function testCompanyNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->unique()->companyNumber();

            $this->assertIsString($result);
            $this->assertMatchesRegularExpression('/^0\d{9}$/', $result);
            $this->assertSame(97 - ((int) substr($result, 0, 8) % 97), (int) substr($result, 8, 2));
        }
    }

    public function testVat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->unique()->vat();

            $this->assertIsString($result);
            $this->assertEquals('BE0', substr($result, 0, 3));
            $this->assertEquals(12, strlen($result));
            $this->assertSame(97 - ((int) substr($result, 2, 8) % 97), (int) substr($result, 10, 2));
        }
    }
}
