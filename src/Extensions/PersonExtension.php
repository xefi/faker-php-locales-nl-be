<?php

namespace Xefi\Faker\NlBe\Extensions;

use DateTimeImmutable;
use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;

class PersonExtension extends BasePersonExtension
{
    /**
     * Get the locale handled by this extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'nl_BE';
    }

    protected $firstNameMale = [
        'Jan', 'Luc', 'Marc', 'Peter', 'Dirk', 'Geert', 'Bart', 'Koen', 'Kris', 'Wim',
        'Johan', 'Patrick', 'Filip', 'Tom', 'Pieter', 'Jens', 'Wouter', 'Stijn', 'Thomas', 'Arne',
        'Lucas', 'Louis', 'Noah', 'Liam', 'Seppe', 'Warre', 'Jules', 'Vic', 'Mats', 'Senne',
        'Ward', 'Robbe', 'Milan', 'Rune', 'Jef', 'Staf', 'Frans', 'Jozef', 'Rik', 'Guido',
    ];

    protected $firstNameFemale = [
        'Maria', 'Anna', 'Els', 'Katrien', 'Sofie', 'Veerle', 'Inge', 'Hilde', 'Griet', 'Leen',
        'Ann', 'Liesbeth', 'Nathalie', 'Sarah', 'Lien', 'Lotte', 'Fien', 'Marie', 'Emma', 'Louise',
        'Elise', 'Julie', 'Hanne', 'Laura', 'Nore', 'Lore', 'Ella', 'Mila', 'Olivia', 'Lena',
        'Jana', 'Febe', 'Jolien', 'Eline', 'Ines', 'Britt', 'Charlotte', 'Margot', 'Kato', 'Ilse',
    ];

    protected $lastName = [
        'Peeters', 'Janssens', 'Maes', 'Jacobs', 'Mertens', 'Willems', 'Claes', 'Goossens', 'Wouters', 'De Smet',
        'Hermans', 'Aerts', 'Pauwels', 'Van den Bossche', 'De Clercq', 'Michiels', 'Martens', 'Verhaegen', 'Van Damme', 'Smets',
        'De Vos', 'Lambrechts', 'Coppens', 'Van de Velde', 'Vermeulen', 'Segers', 'Claeys', 'Verstraete', 'De Backer', 'Cools',
        'Bogaerts', 'Hendrickx', 'Van Hoof', 'Leemans', 'Verbeke', 'Vandenberghe', 'De Meyer', 'Stevens', 'Vermeiren', 'Van Acker',
    ];

    protected $titleMale = ['Dhr.', 'Dr.', 'Prof.', 'Mr.', 'Ir.'];
    protected $titleFemale = ['Mevr.', 'Dr.', 'Prof.', 'Mr.', 'Ir.'];

    /**
     * Get a random national register number (rijksregisternummer) with its modulo 97 check digits.
     *
     * @param ?string $gender
     * @param bool    $formatted
     *
     * @return string
     */
    public function rrn(?string $gender = null, bool $formatted = false): string
    {
        $year = $this->randomizer->getInt(1940, 2023);
        $month = $this->randomizer->getInt(1, 12);
        $daysInMonth = (int) (new DateTimeImmutable(sprintf('%04d-%02d-01', $year, $month)))->format('t');
        $day = $this->randomizer->getInt(1, $daysInMonth);

        if ($gender === static::GENDER_MALE) {
            $order = $this->randomizer->getInt(0, 498) * 2 + 1;
        } elseif ($gender === static::GENDER_FEMALE) {
            $order = $this->randomizer->getInt(1, 499) * 2;
        } else {
            $order = $this->randomizer->getInt(1, 998);
        }

        $base = sprintf('%02d%02d%02d%03d', $year % 100, $month, $day, $order);
        $checksumBase = $year >= 2000 ? '2'.$base : $base;
        $rrn = sprintf('%s%02d', $base, 97 - ((int) $checksumBase % 97));

        if ($formatted) {
            return sprintf('%s %s %s %s %s', substr($rrn, 0, 2), substr($rrn, 2, 2), substr($rrn, 4, 2), substr($rrn, 6, 3), substr($rrn, 9, 2));
        }

        return $rrn;
    }
}
