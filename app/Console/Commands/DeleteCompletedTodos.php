<?php

namespace App\Console\Commands;

use App\Models\Todo;
use Illuminate\Console\Command;

class DeleteCompletedTodos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:destroy {--user_id= : User Id from users table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all completed todos from the database';

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
    public function handle(Todo $model)
    {
        $user_id = $this->option('user_id');

        $query = $model->where('is_complete', '=', 1);

        if ($user_id) {
            $query = $query->where('user_id', '=', $user_id);
        }

        $query->delete();

        $this->info('All completed tasks deleted succcessfully');
    }
}
