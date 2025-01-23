<?php

namespace Kix\PhpstanUtils;

use Nette\Neon\Neon;

/**
 * Use cases:
 * * Count errors based on their type, as in staabm/phpstan-baseline-analysis
 */
final readonly class Collector
{
    /**
     * @return IgnoredError[]
     */
    public function collect(string $filename): array
    {
        $decoded = Neon::decodeFile($filename);
        $coll = new IgnoredErrorCollection();

        if (!array_key_exists('parameters', $decoded)) {
            throw new \RuntimeException('`parameters` key not found in ' . $filename);
        }

        if (!array_key_exists('ignoreErrors', $decoded['parameters'])) {
            throw new \RuntimeException('`ignoreErrors` key not found in ' . $filename);
        }

        foreach ($decoded['parameters']['ignoreErrors'] as $error) {
            $coll->add(IgnoredError::fromNeonDefinition($error));
        }

        return $decoded;
    }
}
