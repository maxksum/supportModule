<?php

namespace Modules\User\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Cache, Carbon;

class UsersOnlineHandler extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'online:handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handling current online users list.';

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
      if (Cache::has("UsersOnline")) {
        $online = Cache::get("UsersOnline");
        foreach ($online as $key=>$user) {
          if ($user->expire_at < Carbon::now()) {
            unset($online[$key]);
          }
        }
        array_values($online);
      } else {
        $online = [];
      }
      Cache::forever("UsersOnline", $online);
    }
}
