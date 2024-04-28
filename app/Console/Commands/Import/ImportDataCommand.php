<?php

namespace App\Console\Commands\Import;

use App\Helpers\ImportDataHelper;
use Illuminate\Console\Command;

class ImportDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data
    {name : the Excel file containing data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports an Excel file';

    /**
     * Execute the console command.
     */
    public function handle(ImportDataHelper $importDataHelper)
    {
        $importDataHelper($this->argument('name'));
    }
}
