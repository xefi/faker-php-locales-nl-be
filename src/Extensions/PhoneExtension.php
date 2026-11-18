<?php

namespace Xefi\Faker\NlBe\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $defaultPrefix = '0';

    public string $indicator = '+32';

    /**
     * Get the locale handled by this extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'nl_BE';
    }

    protected array $landlineFormats = [
        '2{separator}{d}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '3{separator}{d}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '9{separator}{d}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '11{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '15{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '16{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '50{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '53{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '56{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '59{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
    ];

    protected array $cellFormats = [
        '46{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '47{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '48{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '49{d}{separator}{d}{d}{separator}{d}{d}{separator}{d}{d}',
    ];

    /**
     * Generate a phone number, keeping a separator between the indicator and the number.
     *
     * @param string|null $format
     * @param string      $separator
     * @param string|null $prefix
     *
     * @return string
     */
    public function phoneNumber(?string $format = null, string $separator = '', ?string $prefix = null): string
    {
        if ($prefix === $this->indicator) {
            $prefix .= $separator;
        }

        return parent::phoneNumber($format, $separator, $prefix);
    }
}
