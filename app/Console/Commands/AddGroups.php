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
                'name' => 'Javascript',
                'course_name' => 'Modern Javascript Basics',
                'course_description' => "Whether you're migrating from older JavaScript knowledge, starting fresh, or have only ever reached for something like jQuery, this series is designed for you."
            ],
            [
                'name' => 'CSS',
                'course_name' => 'CSS Grids Simplified',
                'course_description' => "Grid is one of the most powerful tools in CSS, but also the most confusing one. Once you master creating layouts with CSS grids, you’ll wonder how you lived without it."
            ],
            [
                'name' => 'Laravel Forgee',
                'course_name' => 'Learn Laravel Forge (2022 Edition)',
                'course_description' => "In this series, Laravel core team member, James Brooks, will steer you through the ins and outs of building and configuring servers with Laravel Forge."
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
