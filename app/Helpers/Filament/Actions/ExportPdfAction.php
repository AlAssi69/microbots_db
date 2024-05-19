<?php

namespace App\Helpers\Filament\Actions;

use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Facades\Blade;

class ExportPdfAction
{
    public static function bulkAction(?array $columns = null): BulkAction
    {
        return BulkAction::make('export_pdf')
            ->label('PDF')
            ->color('success')
            // ->icon('heroicon-s-download')
            ->action(function ($records) use ($columns) {
                $columns ??= $records->first()->getFillables();

                return response()->streamDownload(function () use ($records, $columns) {
                    echo Pdf::loadHtml(
                        Blade::render('pdf', [
                            'records' => $records,
                            'columns' => static::getColumns($columns),
                        ])
                    )->stream();
                }, now()->toDateTimeString().'.pdf');
            });
    }

    private static function getColumns(array $columns): array
    {
        return collect($columns)
            ->toArray();
    }
}
