<?php declare (strict_types = 1);

namespace Demo\Processor\Factory;

use DateInterval;
use Demo\Processor\ProcessorInterface;
use Psr\SimpleCache\CacheInterface;

final class CachedProcessorFactory implements ProcessorFactoryInterface
{
    /** @var CacheInterface */
    private $cache;
    /**
     * @var ProcessorFactoryInterface
     */
    private $factory;

    public function __construct(CacheInterface $cache, ProcessorFactoryInterface $factory)
    {
        $this->cache   = $cache;
        $this->factory = $factory;
    }

    public function build(string $key): ProcessorInterface
    {
        if (false === $this->cache->has($key)) {
            $processor = $this->factory->build($key);
            $this->cache->set($key, $processor, new DateInterval('P1D'));

            return $processor;
        }

        return $this->cache->get($key);
    }
}
