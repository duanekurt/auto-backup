<?php

namespace Savants\AutoBackup;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupCommand extends Command
{
    protected $signature = 'db:backup';

    protected $description = 'Creates backup on current database and makes a copy in local storage';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filename = env('DB_DATABASE') . "-backup-" . Carbon::now()->format('Y-m-d') . ".sql";
        $disk = Storage::disk('local');
        if (!$disk->exists(storage_path().'/app/backup')) {
            $disk->makeDirectory('backup');
        }
        $command = "" . env('DUMP_PATH') . " --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  > " . storage_path() . "/app/backup/" . $filename;
        $returnVar = NULL;
        $output = NULL;
        
        exec($command, $output, $returnVar);
        $config = [
            'content' => "Automatic backup update boyz! 💂",
            'embeds' => [
                [
                    'title' => env('DB_DATABASE') . " has been backed up.",
                    'description' => "File name: " . $filename,
                    'color' => '7506394',
                ]
            ],
        ];
        Http::post(env('DISCORD_WEBHOOK_URL'), $config);
    }
}
