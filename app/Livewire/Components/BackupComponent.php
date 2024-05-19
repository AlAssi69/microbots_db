<?php

namespace App\Livewire\Components;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class BackupComponent extends Component
{

    public function backup()
    {
        Artisan::call('backup:run');

        Notification::make('backup_done')
            ->title('Backup done')
            ->body('Backup run successfully!')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.components.backup-component');
    }
}
