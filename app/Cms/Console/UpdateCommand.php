<?php

namespace App\Cms\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class UpdateCommand extends Command
{

    protected $name = 'cms:update';

    protected $description = 'Updates cms version';

    public function handle()
    {
        $this->info("Updates will be made cms.");

        $this->line('');

        // if (! $this->confirm("Proceed with the migration creation?", "yes")) {
        //     return;
        // }

        // $this->line('');

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

        $this->info("Publishing cms files...");

        if ($this->useVendor()) {
            $this->info("Files successfully published!");
        } else {
            $this->error(
                "Couldn't files publish.\n".
                "Please, try again."
            );
        }

        $this->line('');

    }

    protected function useMigration()
    {
        $this->call('migrate');

        return true;
    }

    protected function useVendor()
    {
        $this->call('vendor:publish', [
            '--tag' => 'update',
            '--force' => true
        ]);

        return true;
    }
}
