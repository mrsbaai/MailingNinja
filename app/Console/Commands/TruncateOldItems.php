<?php

namespace App\Console\Commands;

use App\link;
use Illuminate\Console\Command;

class TruncateOldItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete old data';

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
        Link::where('created_at', '<', Carbon::now()->subDays(14)->toDateTimeString())->each(function ($item) {
            $item->delete();
        });
    }
}
