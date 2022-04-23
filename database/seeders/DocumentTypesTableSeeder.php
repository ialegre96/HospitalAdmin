<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = ['Adhar card', 'PAN card', 'Passport', 'Light Bill'];

        foreach ($input as $value) {
            DocumentType::create(['name' => $value]);
        }
    }
}
