<?php

namespace Modules\Mix\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Modules\Mix\Events\{MixesHandlerEvent};

class MixesHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mixes:handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run mixes handler';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      event(new MixesHandlerEvent());
        //
    }
}
