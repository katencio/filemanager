<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteAllFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:delete-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all uploaded files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = File::all();

        if ($files->isEmpty()) {
            $this->info('No files found to delete.');
            return Command::SUCCESS;
        }

        $deletedCount = 0;
        $totalCount = $files->count();

        $this->info("Deleting {$totalCount} file(s)...");

        foreach ($files as $file) {
            // Delete physical file
            if (Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }

            // Delete database record
            $file->delete();
            $deletedCount++;
        }

        $this->info("Successfully deleted {$deletedCount} file(s).");
        
        return Command::SUCCESS;
    }
}

