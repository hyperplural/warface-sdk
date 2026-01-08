<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hyperplural\WarfaceSdk\Client;
use Hyperplural\WarfaceSdk\Enum\RatingLeague;
use Hyperplural\WarfaceSdk\Enum\GameClass;

$client = new Client();

// Player stats
$stat = $client->rating()->monthly('чпкф', RatingLeague::BRONZE(), )


var_dump($stat);
