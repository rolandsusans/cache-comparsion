<?php declare (strict_types = 1);

namespace Demo\Processor\Factory;

use Demo\Processor\ProcessorInterface;

interface ProcessorFactoryInterface
{
    public function build(string $key): ProcessorInterface;
}
