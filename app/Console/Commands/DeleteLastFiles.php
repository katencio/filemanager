<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteLastFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:delete-last {count=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the last N uploaded files (default: 10)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->argument('count');
        
        $files = File::orderByDesc('uploaded_at')
            ->limit($count)
            ->get();

        if ($files->isEmpty()) {
            $this->info('No files found to delete.');
            return Command::SUCCESS;
        }

        $deletedCount = 0;

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

