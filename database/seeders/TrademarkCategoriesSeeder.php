<?php

namespace Database\Seeders;

use App\Models\TrademarkCategories;
use Illuminate\Database\Seeder;

class TrademarkCategoriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "name"=>"Vehicle"
            ],
            [
                "name" => "Real State"
            ],
            [
                "name" => "Business"
            ]
        ];

        foreach ($data as $key => $value)
        {
            TrademarkCategories::create($value);
        }
    }
}
