<?php declare (strict_types = 1);

namespace Demo\Processor\Factory;

use Demo\Processor\Processor;
use Demo\Processor\ProcessorInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

final class DiskProcessorFactory implements ProcessorFactoryInterface
{
    public function build(string $key): ProcessorInterface
    {
        //TODO get file using key
        $inputFileName = __DIR__ . '/../../../files/excel.xlsx';
        $spreadsheet   = IOFactory::load($inputFileName);

        return new Processor($spreadsheet);
    }
}
