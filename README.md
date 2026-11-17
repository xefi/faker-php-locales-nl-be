# Faker PHP — nl_BE locale

Dutch (Belgium) (`nl_BE`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-nl-be
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('nl_BE');

$faker->name();        // "Lotte Peeters"
$faker->fullAddress(); // "Stationsstraat 12, 9000 Gent"
$faker->rrn();         // "85073003328"
```

Generators without a `nl_BE` variant fall back to the default locale.

## Locale-specific generators

Data covers Flanders and Brussels.

| Method | Extension | Description |
| --- | --- | --- |
| `region()` / `province()` | Address | Flemish and Brussels regions, the 5 Flemish provinces |
| `postcode()` | Address | 4 digits postcode within the Brussels and Flemish ranges |
| `rrn(?string $gender, bool $formatted)` | Person | Rijksregisternummer with its modulo 97 check digits |
| `companyNumber()` | Company | Ondernemingsnummer with its modulo 97 check digits |
| `vat()` | Company | `BE` + ondernemingsnummer |
| `iban()` | Financial | `BE` IBAN with a valid national modulo 97 check |

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add an extension under `src/Extensions/` and register it in `FakerNlBeServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
