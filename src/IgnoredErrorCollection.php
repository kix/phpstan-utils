<?php

namespace Kix\PhpstanUtils;

final class IgnoredErrorCollection
{
    /**
     * @var IgnoredError[]
     */
    private array $errors;

    public function __construct(
    ) {
        $this->errors = [];
    }

    public function add(IgnoredError $error): void
    {
        $this->errors []= $error;
    }

    /**
     * @return IgnoredError[]
     */
    public function all(): array
    {
        return $this->errors;
    }
}
