<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = ['money', 'work', 'travel', 'activities'];

        foreach ($array as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->save();
        }
    }
}
