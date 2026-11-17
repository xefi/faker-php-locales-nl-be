<?php

namespace Xefi\Faker\NlBe\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
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

    protected $provinces = [
        'Antwerpen', 'Limburg', 'Oost-Vlaanderen', 'Vlaams-Brabant', 'West-Vlaanderen',
    ];

    protected $regions = [
        'Vlaams Gewest', 'Brussels Hoofdstedelijk Gewest',
    ];

    protected $cities = [
        'Brussel', 'Antwerpen', 'Gent', 'Brugge', 'Leuven', 'Mechelen', 'Aalst', 'Hasselt', 'Kortrijk', 'Sint-Niklaas',
        'Oostende', 'Genk', 'Roeselare', 'Turnhout', 'Lier', 'Mol', 'Beveren', 'Dendermonde', 'Vilvoorde', 'Halle',
        'Ninove', 'Lokeren', 'Geel', 'Herentals', 'Ieper', 'Tienen', 'Waregem', 'Tongeren', 'Diest', 'Schaarbeek',
        'Anderlecht', 'Elsene', 'Ukkel', 'Sint-Jans-Molenbeek', 'Etterbeek',
    ];

    protected $streetTypes = [
        'straat', 'laan', 'steenweg', 'plein', 'dreef', 'lei', 'weg', 'kaai', 'vest', 'markt',
    ];

    protected $streetNames = [
        'Kerk', 'Stations', 'Dorps', 'School', 'Molen', 'Kapel', 'Nieuw', 'Leopold', 'Albert', 'Astrid',
        'Boudewijn', 'Elisabeth', 'Koning', 'Brouwers', 'Smids', 'Lange', 'Korte', 'Hoog', 'Zand', 'Veld',
        'Beuken', 'Linden', 'Eiken', 'Populieren', 'Kastanje', 'Rozen', 'Tulpen', 'Heide', 'Bos', 'Kouter',
        'Schelde', 'Leie', 'Dijle', 'Demer', 'Nete', 'Rubens', 'Breughel', 'Memling', 'Conscience', 'Gezelle',
    ];

    protected array $postcodeRanges = [
        [1000, 1299], [1500, 3999], [8000, 9999],
    ];

    /**
     * Get a random region name.
     *
     * @return string
     */
    public function region(): string
    {
        return $this->pickArrayRandomElement($this->regions);
    }

    /**
     * Get a random Flemish province name.
     *
     * @return string
     */
    public function province(): string
    {
        return $this->pickArrayRandomElement($this->provinces);
    }

    /**
     * Get a random Flemish or Brussels city name.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomElement($this->cities);
    }

    /**
     * Get a random postcode within the Brussels and Flemish ranges.
     *
     * @return int
     */
    public function postcode(): int
    {
        [$min, $max] = $this->pickArrayRandomElement($this->postcodeRanges);

        return $this->randomizer->getInt($min, $max);
    }

    /**
     * Get a random house number.
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 300);
    }

    /**
     * Get a random street name.
     *
     * @return string
     */
    public function streetName(): string
    {
        return $this->pickArrayRandomElement($this->streetNames).$this->pickArrayRandomElement($this->streetTypes);
    }

    /**
     * Get a random street address.
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%s %d', $this->streetName(), $this->houseNumber());
    }

    /**
     * Get a random full address.
     *
     * @return string
     */
    public function fullAddress(): string
    {
        return sprintf('%s, %d %s', $this->streetAddress(), $this->postcode(), $this->city());
    }
}
