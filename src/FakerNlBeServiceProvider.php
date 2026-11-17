<?php

namespace Xefi\Faker\NlBe;

use Xefi\Faker\NlBe\Extensions\AddressExtension;
use Xefi\Faker\NlBe\Extensions\ColorsExtension;
use Xefi\Faker\NlBe\Extensions\CompanyExtension;
use Xefi\Faker\NlBe\Extensions\FinancialExtension;
use Xefi\Faker\NlBe\Extensions\PersonExtension;
use Xefi\Faker\NlBe\Extensions\PhoneExtension;
use Xefi\Faker\NlBe\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerNlBeServiceProvider extends Provider
{
    /**
     * Register the nl_BE extensions.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            TextExtension::class,
            PhoneExtension::class,
        ]);
    }
}
