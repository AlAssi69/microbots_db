<?php

namespace App\Helpers;

use App\Enums\ExcelSheetEnum;
use App\Models\Member;
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
    public function __invoke(string $name, string $model): void
    {
        SimpleExcelReader::create(base_path("imports/$name"))
            ->noHeaderRow()
            ->skip(1)
            ->getRows()
            ->each(function ($row) use ($model) {
                $model = "App\\Models\\$model";
                $fillable = (new $model)->getFillable();
                $data = [];
                foreach ($fillable as $key => $value) {
                    $data[$value] = $row[$key];
                }
                $model::create($data);
            });
    }
}
