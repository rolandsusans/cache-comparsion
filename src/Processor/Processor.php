<?php declare (strict_types = 1);

namespace Demo\Processor;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

final class Processor implements ProcessorInterface
{
    /**
     * @var Spreadsheet
     */
    private $spreadsheet;

    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet = $spreadsheet;
    }

    public function __wakeup()
    {
        //called when retrieved from cache
    }

    public function input(array $data): void
    {
        echo 'input:' . json_encode($data);
        //fill input into sheet
    }

    public function output(): array
    {
        $cells = $this->spreadsheet->setActiveSheetIndex(0)->toArray(null, true, false, true);
        echo 'output:rows' . count($cells) . ' rows '.PHP_EOL;
        return [];
    }
}
