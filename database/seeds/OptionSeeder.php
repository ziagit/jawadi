<?php

use App\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::truncate();
        $options = [
            [
                'times' => 'Emergency',
                'services' => 'New installation',
                'needs' => 'Benchtop',
                'budgets' => 'Under $500',
                'status' => 'Ready to hire',
                'categories' => 'Plumbers',
            ],
            [
                'times' => 'ASAP',
                'services' => 'Repair existing',
                'needs' => 'Flooring',
                'budgets' => '$500 - $2,000',
                'status' => 'Planning $ budgeting',
                'categories' => 'Cleaners',
            ],
            [
                'times' => 'Next few days',
                'services' => 'Replace existing',
                'needs' => 'Other',
                'budgets' => '$2,000 - $5,000',
                'status' => '',
                'categories' => 'Builders',
            ],
            [
                'times' => 'I am flexible',
                'services' => 'Other',
                'needs' => '',
                'budgets' => 'More than $5,000',
                'status' => '',
                'categories' => 'Painters',
            ],
            [
                'times' => 'Next few weeks',
                'services' => '',
                'needs' => '',
                'budgets' => 'Not sure',
                'status' => '',
                'categories' => 'Handyman',
            ],
            [
                'times' => '',
                'services' => '',
                'needs' => '',
                'budgets' => '',
                'status' => '',
                'categories' => 'Lighting',
            ],
            [
                'times' => '',
                'services' => '',
                'needs' => '',
                'budgets' => '',
                'status' => '',
                'categories' => 'Guardners',
            ],
            [
                'times' => '',
                'services' => '',
                'needs' => '',
                'budgets' => '',
                'status' => '',
                'categories' => 'Electricians',
            ]
     
        ];
        Option::insert($options);
    
    }
}
