<?php declare(strict_types = 1);

use Demo\Cache\Apcu\ApcuCache;
use Demo\Processor\Factory\CachedProcessorFactory;
use Demo\Processor\Factory\DiskProcessorFactory;

require_once __DIR__ . '/../bootstrap/app.php';

apcu_clear_cache();
const USE_CACHE = false;
const TIMES     = 10;

$startTime = microtime(true);
for ($i = 0; $i < TIMES; $i++) {
    $processorFactory = new DiskProcessorFactory();
    if (USE_CACHE === true) {
        $processorFactory = new CachedProcessorFactory(new ApcuCache(), $processorFactory);
    }

    $processor = $processorFactory->build('<l|t>q____________________');
    $processor->input([1, 2, 3]);
    $output = $processor->output();
}
$endTime = microtime(true);

$version = USE_CACHE ? 'Cached Version' : 'Without cache Version';

echo sprintf('%s | Times: %s | Process took %s seconds.', $version, TIMES, $endTime - $startTime) . PHP_EOL;
echo sprintf('%s | Times: %s | Memory allocated in APCu RAM %s file.', $version, TIMES,
        convert(apcu_cache_info()['mem_size'])) . PHP_EOL;
echo sprintf('%s | Times: %s | PHP peak usage %s.', $version, TIMES, convert(memory_get_peak_usage())) . PHP_EOL;

function convert($size)
{
    $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];

    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
}


