<?php

namespace Savants\AutoBackup;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class AutoBackup {
    

    public static function backup() {
        $filename = env('DB_DATABASE') . "-backup-" . Carbon::now()->format('Y-m-d') . ".sql";


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
        Http::post('https://discord.com/api/webhooks/895184851546812456/kmbyCkeAiiTCGzx9TKdOCUc2nMfT1hA0A9_dPah_kyDA84Dwym6uz68mjyBBm0uFhpp9', $config);
    }
}