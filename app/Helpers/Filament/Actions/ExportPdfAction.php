<?php

namespace App\Helpers\Filament\Actions;

use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;

class ExportPdfAction
{
    public static function bulkAction(): BulkAction
    {
        return BulkAction::make('export_pdf')
            ->label('PDF')
            ->color('success')
            // ->icon('heroicon-s-download')
            ->action(function ($records) {
                return response()->streamDownload(function () use ($records) {
                    echo Pdf::loadHtml(
                        Blade::render('pdf', ['records' => $records])
                    )->stream();
                }, now()->toDateTimeString() . '.pdf');
            });
    }
}
