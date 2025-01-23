<?php

namespace Kix\PhpstanUtils;

final readonly class IgnoredError
{
    private const REQUIRED_FIELDS = ['message', 'count', 'path'];
    public function __construct(
        public string $message,
        public int $count,
        public string $path,
    ) {}

    /**
     * @param array{'message': string, 'count': int, 'path': string} $definition
     * @return self
     */
    public static function fromNeonDefinition(array $definition): self
    {
        foreach (self::REQUIRED_FIELDS as $field) {
            if (!array_key_exists($field, $definition)) {
                throw new \RuntimeException('Field `' . $field . '` not found in definition');
            }
        }

        return new self($definition['message'], $definition['count'], $definition['path']);
    }
}