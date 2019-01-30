<?php

namespace App\Cms\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class TemplateCommand extends Command
{

    protected $name = 'cms:template';

    protected $description = 'Change template for cms';

    public function handle()
    {
        $this->info("Currently only 1 site template is available.");

        $this->line('');

    }

}
