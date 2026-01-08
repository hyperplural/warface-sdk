# Warface SDK (PHP)

![Coverage](https://img.shields.io/badge/coverage-100%25-brightgreen)

Fast, PSR‑18 HTTP‑client agnostic SDK for the public Warface API. Requires PHP >= 8.1.

## Installation

```bash
composer require hyperplural/warface-sdk guzzlehttp/guzzle:^7 http-interop/http-factory-guzzle:^1
```

Decoupled from any specific HTTP client via [HTTPlug](https://httplug.io/).

## Quickstart

```php
use Hyperplural\WarfaceSdk\Client;
use Hyperplural\WarfaceSdk\Enum\RatingLeague;
use Hyperplural\WarfaceSdk\Enum\GameClass;

$client = new Client();

// Player stats
$stat = $client->user()->stat('Nickname');

// Player achievements
$achievements = $client->user()->achievements('Nickname');

// Achievement catalog
$catalog = $client->achievement()->catalog();

// Clan info
$clan = $client->clan()->members('ClanName');

// Missions
$missions = $client->game()->missions();

// Ratings
$monthly = $client->rating()->monthly('', RatingLeague::ELITE());
$top100 = $client->rating()->top100(GameClass::MEDIC());
```

## Custom HTTP client

Provide your own PSR‑18 client (e.g., Symfony HttpClient with HTTPlug adapter):

```php
use Hyperplural\WarfaceSdk\Client;
use Symfony\Component\HttpClient\HttplugClient;

$client = Client::createWithHttpClient(new HttplugClient());
```

## References

- Official docs: https://ru.warface.com/wiki/index.php/API
- WFTS (legacy application) as an additional reference source.

## Testing

```bash
composer test
```

Unit tests rely on JSON fixtures and a mock HTTP client — no network required. CI enforces 100% line coverage.

## License

MIT. See LICENSE for details.
