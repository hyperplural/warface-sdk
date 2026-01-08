<?php

declare(strict_types=1);

if ($argc < 3) {
    fwrite(STDERR, "Usage: php tools/coverage-check.php <clover.xml> <min-rate>\n");
    exit(2);
}

$file = $argv[1];
$min = (float)$argv[2];

if (!is_file($file)) {
    fwrite(STDERR, "Clover file not found: {$file}\n");
    exit(2);
}

$xml = new SimpleXMLElement(file_get_contents($file) ?: '');

// Aggregate metrics
$metrics = $xml->xpath('/coverage/project/metrics');
if (!$metrics || !isset($metrics[0]['statements'], $metrics[0]['coveredstatements'])) {
    fwrite(STDERR, "Invalid clover.xml format\n");
    exit(2);
}

$statements = (int) $metrics[0]['statements'];
$covered = (int) $metrics[0]['coveredstatements'];
$rate = $statements > 0 ? $covered / $statements : 0.0;

$percent = round($rate * 100, 2);
echo "Line coverage: {$percent}%\n";

if ($rate + 1e-9 < $min) {
    $minPercent = $min * 100;
    fwrite(STDERR, "Coverage below minimum threshold: {$percent}% < {$minPercent}%\n");
    exit(1);
}

exit(0);

