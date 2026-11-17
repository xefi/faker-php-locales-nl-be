<?php

namespace Xefi\Faker\NlBe\Tests\Unit;

use Xefi\Faker\Calculators\Iban;

final class FinancialExtensionTest extends TestCase
{
    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertEquals(16, strlen($iban));
            $this->assertMatchesRegularExpression('/^BE\d{14}$/', $iban);
            $this->assertTrue(Iban::isValid($iban));

            $check = (int) substr($iban, 4, 10) % 97;
            $this->assertSame($check === 0 ? 97 : $check, (int) substr($iban, 14, 2));
        }
    }
}
