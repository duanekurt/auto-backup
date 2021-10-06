<?php


namespace Savants\AutoBackup;

use Illuminate\Support\ServiceProvider;


class DatabaseBackupProvider extends ServiceProvider {

    public function boot() {
        $this->publishes([
            __DIR__.'/../config/autobak.php' => config_path('autobak.php'),
        ]);
        $this->commands([
            \Savants\AutoBackup\DatabaseBackupCommand::class,
        ]);
    }

    public function register() {
        // $this->app->singleton(AutoBackup::class, function() {
        //     return new AutoBackup();
        // });
    }
}