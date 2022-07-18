<?php

namespace App\Console\Commands;

use App\Models\Group;
use Illuminate\Console\Command;
use App\Utilities\AccredibleService;

class AddGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:groups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add in groups';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AccredibleService $accredible)
    {
        parent::__construct();
        $this->accredible = $accredible;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $groups = [
            [
                'name' => 'Authentication',
                'course_name' => 'Learn Socialite',
                'course_description' => "Socialite provides you with a simple and convenient way to authenticate with OAuth providers like Facebook, Twitter, and GitHub."
            ],
            [
                'name' => 'Queues',
                'course_name' => 'Laravel Queue Mastery',
                'course_description' => "In this series, join Mohamed Said, from the Laravel core team, as he reviews the ins and outs of how to use Laravel's high-performance queue system to run any potentially long-running task asynchronously."
            ],
            [
                'name' => 'React',
                'course_name' => 'Beginning React',
                'course_description' => "React continues to be extremely popular in the front-end world. Whether you’re in the job market or are curious to explore React's massive ecosystem, learning it will help you become a better developer. In this series, we'll review the basics of using React."
            ],
        ];

        $this->createGroups($groups);
    }

    public function createGroups($groups)
    {
        foreach($groups as $group)
        {
            $this->info("Creating group in accredible");

            $acc_group = $this->accredible->create_group($group['name'], $group['course_name'], $group['course_description']);

            $this->info("Creating group in local db");

            Group::create([
                'id' => $acc_group['group']['id'],
                'name' => $acc_group['group']['name'],
                'course_name' => $acc_group['group']['course_name'],
                'certificate_design_id' => $acc_group['group']['certificate_design_id']
            ]);

            $this->info("Group created successfully in local db");
        }
    }
}
