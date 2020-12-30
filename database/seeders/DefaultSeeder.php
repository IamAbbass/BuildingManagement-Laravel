<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

use \App\Models\User;
use \App\Models\Block;
use \App\Models\Floor;
use \App\Models\Flat;
use \App\Models\SMS;
use \App\Models\ExpenseHead;
use \App\Models\Expense;
use \App\Models\Employee;
use \App\Models\Attendance;
use \App\Models\AccountHead;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        //Block
        Block::create(['name' => 'A']);
        Block::create(['name' => 'B']);
        Block::create(['name' => 'C']);
        Block::create(['name' => 'D']);
        Block::create(['name' => 'E']);
        Block::create(['name' => 'F']);
        Block::create(['name' => 'G']);

        //Floor
        $blocks = Block::all();
        foreach($blocks as $block){
            $limit = 6;
            for($i=1; $i<=$limit; $i++){
                Floor::create([
                    'block_id' => $block->id,
                    'name' => $i
                ]);
            }
        }
        
        //Flats
        $floors = Floor::all();
        foreach($floors as $floor){
            $limit = 12;
            for($i=1; $i<=$limit; $i++){
                $flat_no = $i;
                if($flat_no <= 9){
                    $flat_no = "0$flat_no";
                }
                Flat::create([
                    'block_id' => $floor->block_id,
                    'floor_id' => $floor->id,
                    'name' => $floor->block->name.$floor->name.$flat_no,
                ]);
            }
        }  

        //Expense
        ExpenseHead::create(['name' => 'Computer and Others', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Misc Expenses', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Bank Other Charges', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Telecommunication Systems', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Salary & Allowances', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Fl Repair & Maintenance', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Bounus A/c', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Social Expence', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Masjid Exps', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Utilities', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Printing & stationary', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Plumbring R/M', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'N.O.C CERTIFICATE', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'KW&SB', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Building Union Exps', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'WaterTanks', 'created_by' => 1]);
        ExpenseHead::create(['name' => 'Others', 'created_by' => 1]);

        //Account Heads
        AccountHead::create(['name' => 'Monthly Maintainance', 'default_amount' => '10000', 'created_by' => 1]);
        AccountHead::create(['name' => 'Membership (Tenant)', 'default_amount' => '15000', 'created_by' => 1]);
        AccountHead::create(['name' => 'Membership (Purchaser)', 'default_amount' => '60000', 'created_by' => 1]);
        AccountHead::create(['name' => 'Membership (Owner)', 'default_amount' => '40000', 'created_by' => 1]);
        AccountHead::create(['name' => 'RO', 'default_amount' => '10000', 'created_by' => 1]);

        //
        
        // SMS::create([
        //     'column' => 'value'
        // ]);
        // Employee::create([
        //     'column' => 'value'
        // ]);
        // Attendance::create([
        //     'column' => 'value'
        // ]);
    }
}


/*


*/