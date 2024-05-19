<?php

namespace App\Helpers;

use App\Enums\ExcelSheetEnum;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportDataHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Invoke the class instance.
     */
    public function __invoke(string $name): void
    {
        //Colors
        foreach (ExcelSheetEnum::cases() as $sheet) {
            SimpleExcelReader::create(base_path("imports/$name"))
                ->noHeaderRow()
                ->skip(2)
                ->fromSheetName($sheet->value)
                ->getRows()
                ->each(function ($row) use ($sheet) {
                    $this->processSheet($row, $sheet);
                });
        }
    }

    public function processSheet($row, ExcelSheetEnum $type): void
    {
        if ($type == ExcelSheetEnum::Colors) {
            //TODO: Extract information
        } elseif ($type == ExcelSheetEnum::Courses) {
            //
        }
    }
}
