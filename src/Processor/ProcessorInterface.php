<?php declare (strict_types = 1);

namespace Demo\Processor;

interface ProcessorInterface
{
    public function input(array $data): void;

    public function output(): array;
}
