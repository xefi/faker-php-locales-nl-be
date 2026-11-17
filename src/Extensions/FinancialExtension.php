<?php

namespace Xefi\Faker\NlBe\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    /**
     * Get the locale handled by this extension.
     *
     * @return string|null
     */
    public function getLocale(): string|null
    {
        return 'nl_BE';
    }

    /**
     * Get a random IBAN, a Belgian one (account number with its modulo 97 check digits) by default.
     *
     * @param ?string $countryCode
     * @param ?string $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($countryCode === null) {
            $countryCode = 'BE';
        }

        if ($format === null) {
            $account = $this->formatString(str_repeat('{d}', 10));
            $check = (int) $account % 97;
            $format = sprintf('%s%02d', $account, $check === 0 ? 97 : $check);
        }

        return parent::iban($countryCode, $format);
    }
}
