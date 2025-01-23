<?php

namespace Kix\PhpstanUtils;

use http\Exception\RuntimeException;
use Nette\Neon\Neon;

/**
 * Use cases:
 * * Count errors based on their type, as in staabm/phpstan-baseline-analysis
 * * Count errors based on their type, and then group them in a treelike structure
 *   based on their matched arguments
 * * Collect git blame stats on best and worst baseline contributors, taking error
 *   count into accountk
 */
final readonly class Collector
{
    public function collect(string $filename): IgnoredErrorCollection
    {
        $decoded = Neon::decodeFile($filename);

        if (!is_array($decoded)) {
            throw new RuntimeException('Could not decode ' . $filename . '.');
        }

        $coll = new IgnoredErrorCollection();

        if (!array_key_exists('parameters', $decoded)) {
            throw new \RuntimeException('`parameters` key not found in ' . $filename);
        }

        if (!is_array($decoded['parameters'])
            || !array_key_exists('ignoreErrors', $decoded['parameters'])
            || !is_iterable($decoded['parameters']['ignoreErrors'])) {
            throw new \RuntimeException('`ignoreErrors` key not found in ' . $filename);
        }

        foreach ($decoded['parameters']['ignoreErrors'] as $definition) {
            /** @var array{'message': string, 'count': int, 'path': string} $definition */
            $coll->add(IgnoredError::fromNeonDefinition($definition));
        }

        return $coll;
    }
}
