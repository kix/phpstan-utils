<?php

namespace Kix\PhpstanUtils;

final class IgnoredErrorCollection
{
    private array $errors;

    public function __construct(
    ) {
        $this->errors = [];
    }

    public function add(IgnoredError $error): void
    {
        $this->errors []= $error;
    }

    public function all(): array
    {
        return $this->errors;
    }
}
