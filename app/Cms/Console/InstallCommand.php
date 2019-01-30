<?php

namespace App\Cms\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class InstallCommand extends Command
{
    protected $name = 'cms:install';

    protected $description = 'Installes Reverse Systems CMS';

    protected $calls = [
        'laratrust:setup' => 'Installing laratrust'
    ];

    public function handle()
    {
        foreach ($this->calls as $command => $info) {
            $this->line(PHP_EOL . $info);
            $this->call($command);
        }

        $this->info("Using migration...");

        if ($this->useMigration()) {
            $this->info("Migration successfully used!");
        } else {
            $this->error(
                "Couldn't use migration.\n".
                "Please, try again."
            );
        }

        $this->line('');

        $this->info("Seeding...");

        if ($this->useSeed()) {
            $this->info("Database successfully seeded!");
        } else {
            $this->error(
                "Couldn't seed.\n".
                "Please, try again."
            );
        }

        $this->line('');

        $this->info("Publishing cms files...");

        if ($this->useVendor()) {
            $this->info("Files successfully published!");
        } else {
            $this->error(
                "Couldn't files publish.\n".
                "Please, try again."
            );
        }

        $this->info("Creating symbolic link...");

        if ($this->useStorage()) {
            $this->info("Symbolic link successfully created!");
        } else {
            $this->error(
                "Couldn't symbolic link create.\n".
                "Please, try again."
            );
        }

        $this->line('');
    }

    protected function useMigration()
    {
        $this->call('migrate:fresh');

        return true;
    }

    protected function useSeed()
    {
        $this->call('db:seed', [
            '--class' => 'SiteSeeder'
        ]);

        return true;
    }

    protected function useVendor()
    {
        $this->call('vendor:publish', [
            '--tag' => 'install',
            '--force' => true
        ]);

        return true;
    }

    protected function useStorage()
    {
      $this->call('storage:link');

      return true;
    }
}
