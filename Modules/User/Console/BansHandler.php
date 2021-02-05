<?php

namespace Modules\User\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Events\{UpdateStatsEvent};
use Modules\User\Events\{BansHandlerEvent};

class BansHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bans:handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run bans handler';

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
      event(new BansHandlerEvent());
      event(new UpdateStatsEvent());
    }
}
