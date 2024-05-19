<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class GenerateFilamentResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:filament-resources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate filament resources for each models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $models = File::allFiles(app_path('Models'));
        foreach ($models as $file) {
            $model = $file->getFilenameWithoutExtension();
            Artisan::call("make:filament-resource $model -G -F");
        }
    }
}
