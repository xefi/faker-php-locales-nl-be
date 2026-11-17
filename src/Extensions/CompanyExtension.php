<?php

namespace Xefi\Faker\NlBe\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
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

    private array $companies = [
        'Peeters & Zonen BV', 'Vlaamse Bouwgroep NV', 'Janssens Schrijnwerkerij BV',
        'Scheldeport Logistiek NV', 'Kempense Metaalwerken BV', 'Brugse Kantwerkerij CV',
        'Gentse Dakwerken BV', 'Leuvens Adviesbureau BV', 'Mechelse Meubelmakerij BV',
        'Limburgse Mijnstreek Energie NV', 'Kustlijn Vastgoed BV', 'Brouwerij De Leie BV',
        'Westhoek Landbouwcoöperatie CV', 'Antwerpse Diamanthandel NV', 'Hageland Fruitveiling CV',
        'Brabantse Bakkerij Maes BV', 'Noordzee Visserij NV', 'Waasland Transport BV',
        'Dender Drukkerij BV', 'Maes & Claes Architecten BV', 'Kortrijkse Textielgroep NV',
        'Vlaamse Ardennen Recreatie BV', 'Willems Elektrotechniek BV', 'Pajottenland Zorg VZW',
        'Mertens Boekhouding BV', 'Antwerpse Havendiensten NV', 'Demervallei Hoveniers BV',
        'Goossens Garagebedrijf BV', 'Brusselse Mediagroep NV', 'Kempen Software BV',
    ];

    /**
     * Get a random company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Get a random enterprise number (ondernemingsnummer) with its modulo 97 check digits.
     *
     * @return string
     */
    public function companyNumber(): string
    {
        $base = sprintf('0%d', $this->randomizer->getInt(2000000, 9999999));

        return sprintf('%s%02d', $base, 97 - ((int) $base % 97));
    }

    /**
     * Get a random VAT number (btw-nummer), built on an enterprise number.
     *
     * @return string
     */
    public function vat(): string
    {
        return 'BE'.$this->companyNumber();
    }
}
