<?php

namespace Arrilot\LaravelDataAnonymization;

use Arrilot\LaravelDataAnonymization\Commands\AnonymizationInstallCommand;
use Arrilot\LaravelDataAnonymization\Commands\DbAnonymizeCommand;
use Arrilot\LaravelDataAnonymization\Commands\MakeAnonymizerCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.anonymization.install', function ($app) {
            return new AnonymizationInstallCommand($app['files']);
        });

        $this->app->singleton('command.db.anonymize', function ($app) {
            return new DbAnonymizeCommand($app['db']);
        });

        $this->app->singleton('command.make.anonymizer', function ($app) {
            return new MakeAnonymizerCommand($app['files'], $app['composer']);
        });

        $this->commands('command.anonymization.install');
        $this->commands('command.db.anonymize');
        $this->commands('command.make.anonymizer');
    }
}
