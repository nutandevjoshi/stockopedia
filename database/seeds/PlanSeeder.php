<?php

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['code' => 'gb','name'=>'UK','monthly_cost'=>'10','annual_cost'=>'50',],
            ['code' => 'fr','name'=>'France','monthly_cost'=>'10','annual_cost'=>'60',],
            ['code' => 'de','name'=>'Germany','monthly_cost'=>'15','annual_cost'=>'75',],
            ['code' => 'us','name'=>'USA','monthly_cost'=>'25','annual_cost'=>'150',],
            ['code' => 'jp','name'=>'Japan','monthly_cost'=>'15','annual_cost'=>'65',],
        ];
        foreach($data as $record){
            DB::table('plan')->insert(
                [
                    'code' => $record['code'],
                    'name'=>$record['name'],
                    'monthly_cost'=>$record['monthly_cost'],
                    'annual_cost'=> $record['annual_cost'],]
            );
        }
    }
}
